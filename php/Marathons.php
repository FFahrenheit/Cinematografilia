<?php 
    include_once('Connection.php');
    class Marathons
    {
        public $key;
        public $user;
        public $maratonStatus;
        public $userStatus;
        public $valid;
        public $name;
        public $estado;
        public $APIKey = "b27f9641";

        public function __construct($key)
        {
            $this->key = $key;
            $this->user = isset($_SESSION['username']) ? $_SESSION['username'] : "";

            $temp = new Connection();
            $conn = $temp->getConnection();

            $this->valid = ($temp->getCount($conn,
            "SELECT COUNT(*) FROM maraton WHERE clave = $key AND estado = 'aceptado' ")>0);

            $this->name = $temp->getCount($conn,"SELECT nombre FROM maraton WHERE clave = $key");

            if($this->user == "")
            {
                $this->userStatus = "unlogged";
            }
            else if($temp->getCount($conn,"SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = $this->key AND usuario = '$this->user'") > 0)  //Si está dentro
            {
                $this->userStatus = "in";
            }
            else //Si no está dentro
            {
                $this->userStatus = "out";
            }

            $sql = "SELECT DATEDIFF(DATE(NOW()),inicio) as inicio, 
            DATEDIFF(DATE(NOW()),fin) as fin 
            FROM maraton WHERE clave = $this->key";
            $rs = mysqli_query($conn,$sql);
            $data = mysqli_fetch_assoc($rs);
            $inicio = $data['inicio'];
            $fin = $data['fin'];

            if($inicio<0)   //Aún no empieza
            {
                $this->maratonStatus = "waiting";
                $this->estado = "Por empezar";
            }
            else if($fin>0 && $fin <= 7) //Periodo de feedback
            {
                $this->maratonStatus = "feedback";
                $this->estado = "Finalizado";
            }
            else if($fin > 7)
            {
                $this->maratonStatus = "end";
                $this->estado = "Finalizado";
            }
            else 
            {
                $this->maratonStatus = "happening";
                $this->estado = "Sucediendo ahora mismo";
            }

        }

        public function isValid()
        {
            return $this->valid;
        }

        public function getButtons()
        {
            if($this->maratonStatus == "end" && $this->userStatus != "in" || 
            $this->userStatus=="unlogged" && $this->maratonStatus == "happening"||
            $this->userStatus=="out" && $this->maratonStatus == "happening")
            {
                return 
                '<button class="btn btn-warning" disabled>
                    Ya no es posible entrar a este maratón
                </button>';
            }
            if($this->userStatus=="unlogged" && $this->maratonStatus = "waiting")
            {
                return 
                '<button onclick="window.location.href = \'login.php\'"class="btn btn-warning">
                    Inicie sesión para entrar
                </button>';
            }
            if($this->userStatus == "out" && $this->maratonStatus =="waiting")
            {
                return
                '<button onclick="enter('.$this->key.')" class="btn btn-warning">
                    Entrar
                </button>';
            }
            if($this->userStatus == "in" && ($this->maratonStatus == "waiting" || $this->maratonStatus=="happening"))
            {
                return 
                '<button onclick="exit('.$this->key.')" class="btn btn-danger">
                    Salir del maratón
                </button>';
            }
            return "&nbsp;";
        }

        public function getAssistance()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            
            $out  = '<span class="text-warning">Cantidad de asistentes: </span>';
            $out .= '<span class="text-light">';
            $out .= $temp->getCount($conn,"SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = $this->key");
            $out .='</span>';
            $out .= '<br>';       
        
            if($this->maratonStatus=="end" || $this->maratonStatus=="feedback")
            {
                $out .= '<span class="text-warning">Maratoneros que lo finalizaron: </span>';
                $out .= '<span class="text-light">';
                $out .= $temp->getCount($conn,"SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = $this->key AND estado = 'completo'");
                $out .='</span>';
                $out .= '<br>';
            }

            return $out;
        }

        public function getDetails()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            
            $sql = "SELECT *,
            (SELECT COUNT(*) FROM maraton_peliculas WHERE maraton = maraton.clave) as cont
            FROM maraton WHERE clave = $this->key";
            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $data = mysqli_fetch_assoc($rs);
                $out = '<span class="text-warning">Nombre del maratón: </span>';
                $out .= '<span class="text-light">'.$data['nombre'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Estado: </span>';
                $out .= '<span class="text-light">'.$this->estado.'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Cantidad de películas: </span>';
                $out .= '<span class="text-light">'.$data['cont'].'</span>';
                $out .= '<br>';

                $out .= $this->getAssistance();

                $out .= '<span class="text-warning">Anfitrión: </span>';
                $out .= '<span class="text-light"><a  class="text-light" href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></span>';
                $out .= '<br>';                

                $out .= '<span class="text-warning">Fecha de inicio: </span>';
                $out .= '<span class="text-light">'.$data['inicio'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Fecha de fin: </span>';
                $out .= '<span class="text-light">'.$data['fin'].'</span>';
                $out .= '<br>';
                
                $start_date = strtotime($data['inicio']); 
                $end_date = strtotime($data['fin']); 
                $out .= '<span class="text-warning">Duración: </span>';
                $out .= '<span class="text-light">'.($end_date - $start_date)/60/60/24 .' días</span>';
                $out .= '<br>';


                $out .= '<span class="text-warning">Descripción: </span>';
                $out .= '<span class="text-light">'.$data['descripcion'].'</span>';
                $out .= '<br><br>';

                return $out;
            }
            else 
            {
                return "<p>Error al obtener detalles</p>";
            }
        }

        public function getMovieBar()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = ($this->userStatus=="in" && $this->maratonStatus!="waiting")?
            "SELECT *,
            (SELECT COUNT(*) FROM (SELECT * FROM maraton_progreso) as progreso 
            WHERE progreso.maraton =maraton_progreso.maraton AND progreso.pelicula = maraton_progreso.pelicula ) as watchers 
            FROM maraton_progreso WHERE maraton = $this->key AND usuario = '$this->user' ORDER BY fecha ASC"
            :
            "SELECT pelicula, 
            (SELECT COUNT(*) FROM (SELECT * FROM maraton_progreso) as progreso 
            WHERE progreso.maraton =maraton_peliculas.maraton AND progreso.pelicula = maraton_peliculas.pelicula ) as watchers  FROM maraton_peliculas WHERE maraton = $this->key ORDER BY orden ASC";
            
            $out =  ($this->userStatus=="in" && $this->maratonStatus!="waiting")?
            "<p>Progreso de películas</p>" : "<p>Películas del maratón</p>";

            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $out .= 
                '<table class="table table-hover sa_table">
                    <tbody>';
                while($rs && $data = mysqli_fetch_assoc($rs))
                {
                    $mov = $data['pelicula'];
                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=$mov";
                    $content = file_get_contents($url);
                    $movie = json_decode($content,true);
            
                    if($movie['Response']=='True')
                    {
                        $out .= '<tr>';
                
                        $hr = "<a style='color: white;' href = 'movie.php?id=".$movie['imdbID']."'>";
                        if($this->userStatus=="in" && $this->maratonStatus!="waiting")
                        {
                            $out .= '<td>'.$data['fecha'].'</td>';
                        }
                        $poster = ($movie['Poster']=="N/A")? "../../img/poster.jpg" : $movie['Poster'];
                        $out .= "<td>$hr<img src='".$poster."'></a></td>";
                        $out .= "<td>$hr".$movie['Title']." (".$movie['Year'].") </a></td>";
                        
                        if($this->maratonStatus != "waiting")
                        {
                            $msg = $this->maratonStatus == "happening" ? " la han visto" : " la vieron";
                            $out .= '<td>'.$data['watchers'].$msg.'</td>';
                        }
                                        
                        $out .= '</tr>';
                    }
                }
                $out .= '</tbody>
                </table>';
                return $out;
            }
            else 
            {
                return $out. "<p>No hay películas aún</p>";
            }
        }

        public function getAction()
        {
            if($this->maratonStatus == "end")
            {
                //Obtener feedback
            }
            else if($this->userStatus == "in")
            {
                $temp = new Connection();
                $conn = $temp->getConnection();
                if($this->maratonStatus =="happening")
                {

                    $sql = "SELECT pelicula FROM maraton_peliculas 
                    WHERE maraton = $this->key AND pelicula NOT IN 
                    (SELECT pelicula FROM maraton_progreso WHERE usuario = '$this->user' AND maraton = $this->key) 
                    ORDER BY orden ASC LIMIT 1";

                    $rs = mysqli_query($conn,$sql);

                    if($rs && $rs->num_rows>0)
                    {
                        $out = ' <p>Siguiente película:</p>';
                        if($data = mysqli_fetch_assoc($rs))
                        {
                            $mov = $data['pelicula'];
                            $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=$mov";
                            $content = file_get_contents($url);
                            $movie = json_decode($content,true);

                            if($movie['Response']=='True')
                            {                        
                                $hr = "<a style='color: white;' href = 'movie.php?id=".$movie['imdbID']."'>";  //href
                                $poster = ($movie['Poster']=="N/A")? "../../img/poster.jpg" : $movie['Poster']; //poster

                                $out .= "$hr<p>".$movie['Title']." (".$movie['Year'].")</p></a>";
                                $out .= "$hr<img src='".$poster."'></a><hr>";

                                $out .= 
                                '<button class="btn btn-warning" onclick="seeMovie(\''.$mov.'\','.$this->key.')">
                                    Marcar como vista
                                </button><hr>';                                              
                            }
                        }
                        return $out;
                    }
                    else 
                    {
                        return 
                        "<p>
                            ¡Felicidades! Has acabado el maratón. Espera a que finalice para dar tu feedback en 
                            los próximos 7 días.
                        </p>
                        <img src='../../img/logo.png'>
                        <br><br>";
                    }
                }
                else if($this->maratonStatus == "feedback")
                {
                    $sql = "SELECT COUNT(*) FROM maraton_feedback WHERE usuario = '$this->user' AND mararon = $this->key";
                    
                    return $temp->getCount($conn,$sql) != 0 ?  
                    '<p>Dé su feedback acerca del maratón </p>
                    <form id="feedback" novalidate>
                            <div class="form-group">
                                <label for="">Feedback: </label>
                                <br>
                                <textarea name="feedback" style="max-width: 100%" class="form-control" 
                                rows="6" maxlength="500" placeholder="Escriba su opinión sobre el maratón" required></textarea>
                                <br>
                                <div class="invalid-feedback">
                                    Escriba su feedback
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning"type="submit">
                                    Enviar feedback
                                </button>
                            </div>
                        </form>'
                    :
                    '<strong>
                    ¡Gracias por su participación! Su feedback y el de los demás usuarios 
                    estarán disponibles 7 días después de finalizado el maratón.
                    </strong>';
                }
            }
        }
    }
?>