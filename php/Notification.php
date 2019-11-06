<?php 
    class Notification
    {
        public $APIKey = "b27f9641";
        public $counter=0; 
        public $req = 0;
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
            $this->msg = $temp->getCount($conn, "SELECT COUNT(*) FROM chat WHERE receptor = '$this->user' AND visto = 0");
            $this->counter += $this->msg;
            $this->rec = $temp->getCount($conn, "SELECT COUNT(*) FROM recomendacion WHERE receptor = '$this->user' AND visto = 0");
            $this->counter += $this->rec;

        }

        public function getNav()
        {
            $nav = '<li class="nav-item dropdown">
                <a title="Notificaciones" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-111" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">';
            $nav.= $this->counter == 0 ? '<i class="far fa-bell bright"></i>' :
            '<i title="Hay pendientes" class="fas fa-bell brigth"></i>';
            $nav .= '</a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-111">';

            $nav .= $this->req == 0? 
            '<a class="dropdown-item bg-light" href="friend-requests.php">Solicitudes</a>': 
            '<a class="dropdown-item bg-light" title="Solicitudes pendientes" href="friend-requests.php"> <span class="font-weight-bold">Solicitudes</span>
            <span class="badge badge-warning">'.$this->req.'</span>
            </a> ';
            
            $nav .= $this->rec == 0 ?
            '<a class="dropdown-item bg-light" href="recomendations.php">Recomendaciones</a>': 
            '<a class="dropdown-item bg-light" title="Recomendaciones sin ver" href="recomendations.php"> <span class="font-weight-bold">Recomendaciones</span>
            <span class="badge badge-warning">'.$this->rec.'</span>
            </a> ';
            
            $nav .= $this->msg==0?
                '<a class="dropdown-item bg-light" href="chats.php">Mensajes</a>':
                '<a class="dropdown-item bg-light" title="Mensajes sin leer" href="chats.php"> <span class="font-weight-bold">Mensajes</span>
                <span class="badge badge-warning">'.$this->msg.'</span>
                </a> ';
            $nav .= '</div>
            </li>';
            return $nav;
        }

        public function getRecomendations()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen as img, usuario.username as user, recomendacion.pelicula as movie, 
            recomendacion.visto as visto 
            FROM usuario,recomendacion WHERE receptor = '$this->user' AND recomendacion.emisor = usuario.username 
            ORDER BY visto ASC, fecha ASC";
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $user = $data['user'];
                    $arg = "'".$data['movie']."'";
                    $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";

                    $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                    $out .= "<td>$hr".$data['user']."</a></td>";

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['movie'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['movie']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";

                    $out .= '<td><a title="Agregar a vistas" onclick="addWatched('.$arg.')"><i class="fas fa-eye"></i></a></td>';
                    $out .= '<td><a title="Agregar a lista por ver" onclick="addWatchlist('.$arg.')"><i class="fas fa-clock"></i></a></td>';
                    $out .= '<td><a title="Eliminar recomendaciones de esta película" onclick="deleteR('.$arg.')"><i class="fas fa-trash"></i></a></td>';
                    $out .= '<td><a title="Bloquear y eliminar recomendacion" onclick="block('.$arg.')"><i class="fas fa-ban"></i></a></td>';
                    $out .= '</tr>';
                }
                $sql = "UPDATE recomendacion SET visto = 1 WHERE receptor = '$this->user'";
                mysqli_query($conn,$sql);
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No tienes recomendaciones, ¡Explora películas y comienza a recomendarlas!</p>";
            }
        }

        public function getSentRecomendations()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen as img, usuario.username as user, recomendacion.pelicula as movie, 
            recomendacion.visto as visto 
            FROM usuario,recomendacion WHERE emisor = '$this->user' AND recomendacion.receptor = usuario.username 
            ORDER BY visto ASC, fecha ASC";

            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $user = $data['user'];
                    $arg = "'".$data['movie']."'";
                    $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";

                    $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                    $out .= "<td>$hr".$data['user']."</a></td>";

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['movie'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['movie']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No has enviado recomendaciones. ¡Explora películas y comienza a recomendarlas!</p>";
            }
        }

        public function getBlockedRecomendations()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT pelicula as movie FROM recomendacion_bloqueo WHERE usuario = '$this->user'";

            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $arg = "'".$data['movie']."'";

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['movie'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['movie']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $out .= '<td><a title="Desbloquear recomendación" onclick="unblockMovie('.$arg.')"><i class="fas fa-unlock"></i></a></td>';

                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No has bloqueado ninguna recomendación</p>";
            }
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
                    $out .= '<td><button class="btn btn-danger" onclick="reject('.$arg.')">Eliminar solicitud</a></td>';
                    $out .= '<td><button class="btn btn-secondary" onclick="block('.$arg.')">Bloquear</a></td>';
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
                superior derecha para empezar a agregar amigos</p>";
            }
        }

        public function getChats()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen AS 'img', usuario.username as 'user', 
            (SELECT chat.fecha FROM chat WHERE (chat.emisor = '$this->user' AND chat.receptor = usuario.username)
             OR (chat.emisor = usuario.username AND chat.receptor = '$this->user') ORDER BY chat.fecha DESC LIMIT 1)
              as sorted FROM amistad, usuario WHERE amistad.amigo = usuario.username AND amistad.usuario = '$this->user'
              ORDER BY sorted DESC";

            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table id="chat-table" class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $friend = $data['user'];
                    $sql = "SELECT * FROM chat WHERE emisor = '$this->user' AND receptor = '$friend' 
                    OR receptor = '$this->user' AND emisor = '$friend' ORDER BY fecha DESC LIMIT 1";

                    $tmp = new Connection();
                    $con = $tmp->getConnection();

                    $rs = mysqli_query($con,$sql);
                    if($rs && $rs->num_rows>0)
                    {
                        $body = mysqli_fetch_assoc($rs);
                        $out .= '<tr>';
                        $user = $data['user'];
                        $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";
                        $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                        $out .= "<td>$hr".$data['user']."</a></td>";
                        if($body['receptor'] == $this->user)
                        {
                            if($body['visto']==0)
                            {
                                $out .= '<td title="Mensaje sin leer" style="font-weight: bold;" class="text-warning">'.$body['mensaje'].'</td>';
                            }
                            else 
                            {
                                $out .= '<td>'.$body['mensaje'].'</td>';
                            }
                        }
                        else 
                        {
                            if($body['visto']==1)
                            {
                                $out .= '<td><i title="Mensaje leído por el usuario"style="font-size: 20px;" class="fas fa-check-double mini-i"></i>  '.$body['mensaje'].'</td>';
                            }
                            else 
                            {
                                $out .= '<td><i title="Mensaje enviado"style="font-size: 20px;" class="fas fa-check"></i>  '.$body['mensaje'].'</td>';
                            }
                        }
                        $out .= '<td>'.$body['fecha'].'</td>';
                        $out .= '<td><a class="btn btn-warning" href="chat.php?user='.$data['user'].'">Ver conversación</a></td>';
                        $out .= '</tr>';
                    }
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No hay chats recientes.</p>";
            }
        }

        public function getContacts()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT usuario.imagen AS 'img', usuario.username as 'user' 
            FROM amistad, usuario WHERE amistad.amigo = usuario.username AND amistad.usuario = '$this->user'";
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    if($data['user']!='admin')
                    {
                        $out .= '<tr>';
                        $user = $data['user'];
                        $hr = "<a style='color: white;' href = 'profile.php?user=$user'>";
                        $out .= "<td>$hr<img src='".$data['img']."'></a></td>";
                        $out .= "<td>$hr".$data['user']."</a></td>";
                        $out .= '<td><a class="btn btn-warning" href="chat.php?user='.$data['user'].'">Enviar mensaje</a></td>';
                        $out .= '<td><a class="btn btn-warning" href="profile.php?user='.$data['user'].'">Visitar perfil</a></td>';
                        $out .= '</tr>';
                    }
                }
                $out .= '</tbody></table>';
                return $out;
            }        
            else 
            {
                return "<p>No tienes contactos, dirigete a solicitudes
                para agregar amigos o aceptarlos.</p>";
            }
        }
    }
?>