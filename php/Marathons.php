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
            else if($fin>0 && $fin <= 7)
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
            "SELECT * FROM maraton_progreso WHERE maraton = $this->key AND usuario = '$this->user' ORDER BY fecha ASC"
            :
            "SELECT pelicula FROM maraton_peliculas WHERE maraton = $this->key ORDER BY orden ASC";
            
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
    }
?>