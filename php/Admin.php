<?php 
    include_once("Connection.php");
    class Admin
    {
        public $isAdmin;
        public $APIKey;
        public $actual;

        public function __construct()
        {
            $this->isAdmin = isset($_SESSION['username']) && $_SESSION['username']=='admin';
            $this->APIKey ="b27f9641";
        }

        public function getQueue()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * FROM preguntas WHERE estado = 'cola' ORDER BY fecha ASC";

            $result = mysqli_query($conn,$sql);

            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                // $out .= '<thead><tr><th>&nbsp;</th><th>Usuario</th><th>Reseña</th><th>Razón</th>
                // <th>&nbsp;</th><th>Película</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $out .= '<td>'.$data['pregunta'].'</td>';
                    $arg = "'".$data['clave']."'";
                    $out .= '<td><a title="Eliminar pregunta" onclick="deleteQuestion('.$arg.')">
                    <i class="fas fa-trash"></i></a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>Por el momento no hay preguntas en espera. Agregue preguntas en la sección agregar</h4>";
            }
        }

        public function getReports()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen as img, review.texto as texto, review.usuario as user, review.pelicula as movie, 
            review_reporte.razon as razon, review.clave as clave1, review_reporte.clave as clave2  
            FROM review, review_reporte,usuario WHERE review_reporte.review = review.clave AND 
            review.usuario = usuario.username";

            $result = mysqli_query($conn,$sql);

            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                $out .= '<thead><tr><th>&nbsp;</th><th>Usuario</th><th>Reseña</th><th>Razón</th>
                <th>&nbsp;</th><th>Película</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $user = $data['user'];
                    $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";

                    $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                    $out .= "<td>$hr".$data['user']."</a></td>";

                    $out .= "<td>".$data['texto']."</td>";
                    $out .= "<td>".$data['razon']."</td>";

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['movie'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['movie']."'>";
                    $out .= "<td>$hr<img src='".$body['Poster']."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";

                    $out .= '<td><a title="Borrar reseña" onclick="deleteRev('."'".$data['clave1']."'".')"><i class="fas fa-ban"></i></a></td>';
                    $out .= '<td><a title="Descartar reporte" onclick="discardRev('."'".$data['clave2']."'".')"><i class="fas fa-trash-restore-alt"></i></a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>¡Genial! No hay reportes pendientes</h4>";
            }
        }

        public function getMarathons()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT *, 
            (SELECT COUNT(*) FROM maraton_peliculas WHERE maraton = maraton.clave)
             AS cont FROM maraton WHERE estado = 'revision'";
            
            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                $out .= '<thead><tr><th>Nombre</th><th>Películas</th><th>Por</th><th>Empieza</th><th>Termina</th>
                <th>Similaridad</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= "<tr>";
                    
                    $out .= '<td>'.$data['nombre'].'</td>';
                    $out .= '<td>'.$data['cont'].'</td>';
                    $out .= '<td><a class="text-light" href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td>'.$data['inicio'].'</td>';
                    $out .= '<td>'.$data['fin'].'</td>';
                    $out .= '<td>'.$this->getWarnings($data['clave']).'</td>';
                    $out .= '<td><a href="review-marathon.php?clave='.$data['clave'].'" class="btn btn-warning text-dark">Ver detalles</a></td>';

                    $out .= "</tr>";
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>No hay maratones pendientes</h4>";
            }
        }

        private function getWarnings($key)
        {
            $temp = new Connection();
            $temp2 = new Connection();
            $conn = $temp->getConnection();
            $conn2 = $temp2->getConnection();
            $warnings = 0;
            $out="";


            $sql = "SELECT pelicula FROM maraton_peliculas WHERE maraton = $key";
            $rs = mysqli_query($conn,$sql);

            $myMovies = $this->getArray($rs);

            $sql = "SELECT clave FROM maraton WHERE estado = 'aceptado' AND DATE(NOW()) <= fin AND clave != $key";
            $rs = mysqli_query($conn,$sql);

            while($data = mysqli_fetch_assoc($rs))
            {
                $sql = "SELECT pelicula, 
                (SELECT nombre FROM maraton WHERE clave = maraton_peliculas.maraton) as nombre
                FROM maraton_peliculas WHERE maraton =".$data['clave'];
                $rs2 = mysqli_query($conn2,$sql);

                $compare = $this->getArray($rs2);

                $diff = array_diff($myMovies,$compare);
                $perc = (100 * (count($myMovies) - count($diff))) / (floor((count($myMovies) + count($compare))/2));
                if($perc >= 75)
                {
                    $out .= '<a class="dropdown-item bg-light text-dark" href="review-marathon.php?clave='.$data['clave'].'">'
                    .$this->actual." ($perc%)".
                    '</a>';
                    $warnings++;
                }
            }
            return $warnings>0 ?
                '<a title="Nuevo" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-222" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-exclamation-triangle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-222">'.$out.
                '</div>'
                : 
                '<i title="No hay advertencia de maratón repetido" class="fas fa-check"></i>';
        }

        private function getArray($result)
        {
            $array = array();
            $i = 0;
            while($data = mysqli_fetch_assoc($result))
            {
                $array[$i] = $data['pelicula'];
                if(isset($data['nombre']))
                {
                    $this->actual = $data['nombre'];
                }
                $i++;
            }
            return $array;
        }

        public function getMarathonAnswers($key)
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            
            $sql = "SELECT * FROM maraton WHERE clave = $key";
            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $data = mysqli_fetch_assoc($rs);
                $out = '<span class="text-warning">Nombre del maratón: </span>';
                $out .= '<span class="text-light">'.$data['nombre'].'</span>';
                $out .= '<br>';

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

                $out .= '<span class="text-white">Información privada:</span><br>';

                $out .= '<span class="text-warning">Tipo de películas en el maratón: </span>';
                $out .= '<span class="text-light">'.$data['tipo'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Publico dirigido: </span>';
                $out .= '<span class="text-light">'.$data['publico'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Género más abundante: </span>';
                $out .= '<span class="text-light">'.$data['genero'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Intención del maratón: </span>';
                $out .= '<span class="text-light">'.$data['intencion'].'</span>';
                $out .= '<br>';

                $out .= '<span class="text-warning">Razón del nombre del maratón: </span>';
                $out .= '<span class="text-light">'.$data['razon'].'</span>';
                $out .= '<br>';

                return $out;
            }
            else 
            {
                return "<p>Error al obtener detalles</p>";
            }
        }

        public function getMarathonButtons($key)
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            if($temp->getCount($conn,"SELECT estado FROM maraton WHERE clave = $key") == 'revision')
            {
                return '<button class="btn btn-danger" onclick="send(\''.$key.'\',\'rechazo\')">Rechazar</button>
                     <button class="btn btn-success" onclick="send(\''.$key.'\',\'aceptado\')">Aceptar</button>';
            }
            else 
            {
                return '<button class="btn btn-secondary" disabled>Opciones no disponibles</button>';
            }
        }
    }
?>