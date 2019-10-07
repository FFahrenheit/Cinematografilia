<?php 

    class Notification
    {
        public $counter=0; 
        public $req;
        public $rec = 0;
        public $msg = 0;
        public $user;

        public function __construct($user)
        {
            $this->user = $user;
            $temp = new Connection();
            $conn = $temp->getConnection();

            $this->req = $temp->getCount($conn, "SELECT COUNT(*) FROM solicitud WHERE estado = 'pendiente' AND receptor  = '$user'");
            $this->counter += $this->req;
        }

        public function getNav()
        {
            $nav = '<li class="nav-item dropdown">
                <a title="Nuevo" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-111" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">';
            $nav.= $this->counter == 0 ? '<i class="far fa-bell bright"></i>' :
            '<i title="Hay pendientes" class="fas fa-bell brigth"></i>';
            $nav .= '</a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-111">';
            $nav .= $this->req == 0? 
            '<a class="dropdown-item bg-light" href="friend-requests.php">Solicitudes</a>': 
            '<a class="dropdown-item bg-light" title="Solicitudes pendientes" href="friend-requests.php" <span class="font-weight-bold">Solicitudes</span></a> ';
            $nav .= '<a class="dropdown-item bg-light" href="friend-requests.php">Reconendaciones</a>
                <a class="dropdown-item bg-light" href="#">Mensajes</a>
            </div>
            </li>';
            return $nav;
        }

        public function getFriendRequests()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen AS 'img', usuario.username as 'user', solicitud.fecha as 'time'
            FROM solicitud, usuario WHERE solicitud.emisor = usuario.username AND solicitud.receptor = '$this->user'
            AND estado = 'pendiente' ORDER BY time DESC";
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $arg = "'".$data['user']."'";
                    $user = $data['user'];
                    $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";
                    $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                    $out .= "<td>$hr".$data['user']."</a></td>";
                    $out .= '<td><button class="btn btn-success" onclick="accept('.$arg.')">Aceptar</a></td>';
                    $out .= '<td><button class="btn btn-danger" onclick="reject('.$arg.')">Rechazar</a></td>';
                    $out .= '<td>'.$data['time'].'</td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No hay solicitudes por el momento</p>";
            }
        }

        public function getSentFriendRequests()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen AS 'img', usuario.username as 'user', solicitud.fecha as 'time'
            FROM solicitud, usuario WHERE solicitud.receptor = usuario.username AND solicitud.emisor = '$this->user'
            AND estado = 'pendiente' ORDER BY time DESC";
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $arg = "'".$data['user']."'";
                    $user = $data['user'];
                    $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";
                    $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                    $out .= "<td>$hr".$data['user']."</a></td>";
                    $out .= '<td><button class="btn btn-secondary" onclick="cancel('.$arg.')">Cancelar</a></td>';
                    $out .= '<td>'.$data['time'].'</td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No has enviado solicitudes, haz click en el signo de + en la esquina
                superior izquierda para empezar a agregar amigos</p>";
            }
        }
    }
?>