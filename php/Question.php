<?php 
    include_once("Connection.php");

    class Question
    {
        public $user;
        public $active;
        public $idPast;
        public $APIKey="b27f9641";

        public function __construct()
        {
            if(isset($_SESSION['username']))
            {
                $this->user = $_SESSION['username'];
            }
            else 
            {
                $this->user = null;
            }
        }

        public function getPastQuestion()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * FROM preguntas WHERE estado = 'inactiva' ORDER BY fecha DESC LIMIT 1";

            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $data = mysqli_fetch_assoc($rs);
                $this->idPast = $data['clave'];
                return $data['pregunta'];
            }
            else 
            {
                $this->idPast = 0;
                return "No hay información de la pregunta de la semana pasada";
            }
        }

        public function getResults()
        {
            if($this->idPast == 0)
            {
                return "";
            }
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * , COUNT(pelicula) as cont FROM respuestas 
            WHERE pregunta = $this->idPast GROUP BY pelicula ORDER BY cont DESC,pelicula ASC";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $i = 0;
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= '<tr>';
                    // $arg = "'".$data['pelicula']."'";
                    switch($i)
                    {
                        case 0:
                            $out .= '<td><i title="Primer lugar"class="fas fa-trophy"></i></td>';
                            break;
                        case 1:
                            $out .= '<td><i title="Segundo lugar" class="fas fa-medal"></i></td>';
                            break;
                        case 2:
                            $out .= '<td><i title="Tercer lugar"class="fas fa-award"></i></td>';
                            break;
                        default:
                            $out .= "<td>&nbsp;</td>";
                            break;
                    }

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['pelicula'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['pelicula']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $ad = $data['cont']==1 ? "voto." : "votos.";

                    $out .= "<td>".$data['cont']." $ad</td>";

                    $out .= '</tr>';
                    $i++;
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>Esta pregunta no obtuvo respuestas</p>";
            }
        }

        public function getQuestion()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT pregunta FROM preguntas WHERE estado = 'activa'";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $this->active = true;
                $data = mysqli_fetch_assoc($rs);
                return $data['pregunta'];
            }
            else 
            {
                $this->active=false;
                return "Por el momento no hay una pregunta qué responder<br>Vuelve más tarde";
            }
        }

        public function getSearchBar()
        {
            if($this->user == null && $this->active)
            {
                return '<a href="login.php">Inicia sesión para contestar la pregunta</a>';
            }
            else if($this->active)
            {
                $temp = new Connection();
                $conn = $temp->getConnection();

                if($temp->getCount($conn,"SELECT COUNT(*) FROM respuestas WHERE 
                usuario = '$this->user' AND pregunta = (SELECT clave FROM preguntas WHERE estado = 'activa' LIMIT 1)")==0)
                {
                    return 
                    '<form id="answer">
                        <div class="form-group">
                            <label for="">Respuesta: </label>
                            <br>
                            <input id="name" onkeyup="search()" name="name" type="text" placeholder="Busque la película para su respuesta" class="form-control" required minlength="2">
                            <a onclick="searche()" class="btn btn-warning text-dark" style="padding-left:10px;cursor:pointer;">Buscar</a>
                            <button type="submit" class="btn btn-success">Enviar</button>
                            
                        </div>
                    </form>';
                }
                else 
                {
                    return 
                    '<h3><strong>Ya ha enviado una respuesta, pero puede editarla si así lo desea</strong></h3>
                    <form id="answer">
                        <div class="form-group">
                            <label for="">Respuesta: </label>
                            <br>
                            <input id="name" onkeyup="search()" name="name" type="text" placeholder="Busque la película para su respuesta" class="form-control" required minlength="2">
                            <button class="btn btn-warning">Enviar</button>
                        </div>
                    </form>';
                }
            }
            else
            {
                return "";
            }
        }
    }

?>