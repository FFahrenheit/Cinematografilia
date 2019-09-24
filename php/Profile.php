<?php 
    require_once('main.php');
    class Profile
    {
        public $conn;
        public $username; //Del perfil
        public $image;
        public $date;
        public $APIKey; 
        public $exists = true;
        public $user; //Quien solicita

        public function __construct($id)
        {
            $this->user = (isset($_SESSION['username']))? $_SESSION['username'] : "";
            $temp = new Connection();
            $this->APIKey = "b27f9641";
            $this->conn = $temp->getConnection();
            $this->username = $id;
            $sql = "SELECT imagen, date(origen) as date FROM usuario WHERE username = '$id'";
            $result = mysqli_query($this->conn,$sql);
            if($result->num_rows>0)
            {
                $data = mysqli_fetch_assoc($result);
                $this->image = $data['imagen'];
                $this->date = $data['date'];
            }
            else 
            {
                $this->exists = false;
            }
        }

        private function is($request)
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            switch($request)
            {
                case "blocked": //Fue bloqueado
                    $query = "SELECT * FROM bloqueo WHERE bloqueado = '$this->user' AND usuario = '$this->username'";
                    break;
                case "block": //El lo bloqueo
                    $query = "SELECT * FROM bloqueo WHERE bloqueado = '$this->username' AND usuario = '$this->user'";
                    break;
                case "friend":
                    $query = "SELECT * FROM amistad WHERE (usuario = '$this->username' AND amigo = '$this->user')
                    OR (amigo = '$this->username' AND usuario = '$this->user')";
                    break;
                case "pending":
                    $query = "SELECT * FROM solicitud WHERE emisor = '$this->username' AND receptor = '$this->user' AND estado = 'pendiente'";
                    break;
                case "sent":
                    $query = "SELECT * FROM solicitud WHERE emisor = '$this->user' AND receptor = '$this->username' AND estado = 'pendiente'";
                    break;
                default:
                    return false;
            }
            $result = mysqli_query($conn,$query);
            return $result && $result->num_rows > 0;
        }

        public function getUser()
        {
            $arg = "'".$this->username."'";
            if($this->username == $this->user)
            {
                return $this->username.' <a href="configure.php" title="Configurar"><i class="fas fa-cog"></i></a>';
            }
            else if($this->is("blocked"))
            {
                return $this->username.' <span class="badge badge-pill badge-danger">Este usuario te ha bloqueado.</span>';
            }
            else if($this->is("block"))
            {
                return $this->username.' <span class="badge badge-pill badge-warning">Bloqueaste a este usuario.</span><a onclick="unblock('.$arg.')"> <span style="text-decoration:underline;">Desbloquear</span></a>';
            }
            else if($this->is("friend"))
            {
                return $this->username.' <a href="chat.php?user='.$this->username.'" title="Enviar mensaje"><i class="fas fa-envelope"></i></a>';
            }
            else if($this->is("pending"))
            {
                return $this->username.' <button onclick="accept('.$arg.')" class="btn btn-warning">Aceptar</button> <button onclick="reject('.$arg.')" class="btn btn-secondary">Rechazar</button>';
            }
            else if($this->is("sent"))
            {
                return $this->username.' <i title="Solicitud pendiente" class="fas fa-user-clock"></i><a style="text-decoration:underline;" onclick="cancel('.$arg.')"><span>Cancelar solicitud</span></a>';
            }
            else 
            {
                return $this->username.' <a onclick="add('.$arg.')" title="Agregar como amigo"><i class="fas fa-user-plus"></i></a>';
            }
        }

        public function getImage()
        {
            return $this->image;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function isReal()
        {
            return $this->exists;
        }

        public function getMovieRow($id)
        {
            $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=".$id;
            $content = file_get_contents($url);
            $json = json_decode($content,true);
            $data = "<td height='40' width='40'><div><a style='color: white;' href='movie.php?id=$id'><img src='".$json['Poster']."'></a></td>";
            $data .= "<td><a style='color: white;' href='movie.php?id=$id'>".$json['Title']."</a></td>";
            $data .= "<td>".$json['Year']."</td>";
            return $data; 
        }

        public function getWatched()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT *,DATE(fecha) as vista FROM vistas WHERE usuario = '$this->username' ORDER BY fecha DESC";
            $result = mysqli_query($this->conn,$sql);
            if($result && $result->num_rows > 0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['vista']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a data-toggle="modal" data-target="#exampleModal" onclick="unwatched('."'".$data['pelicula']."'".')" title="Quitar de la lista"><i class="fas fa-eye-slash"></i></a></td>';
                    }
                    $out .= '<td><a class="btn btn-warning" href="movie.php?id='.$data['pelicula'].'">Ver película</a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>El usuario aún no ha agregado películas vistas.</p>";
            }            
        }

        public function getPlaylists()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT *, DATE(fecha) AS creada FROM playlist WHERE creador = '$this->username'";
            $result = mysqli_query($this->conn, $sql);
            if($result && $result->num_rows>0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $clave = $data['clave'];
                    $out .= "<td><a style='color: white;' href='playlist.php?id=$clave'>".$data['nombre']."</a>";
                    $out .= '<td><h6>'.$data['descripcion'].'</span></h6>';
                    $out .= '<td>'.$data['creada'].'</td>';
                    $sql = "SELECT (SELECT COUNT(*) FROM playlist_likes WHERE playlist = $clave) AS likes, 
                    (SELECT COUNT(*) FROM playlist_peliculas WHERE playlist = $clave) AS peliculas";
                    $t = new Connection();
                    $connect = $t->getConnection();
                    $rs = mysqli_query($connect,$sql);
                    if($rs)
                    {
                        $body = mysqli_fetch_assoc($rs);
                        $out .= '<td><i title="Me gustas" class="fas fa-thumbs-up"></i> '.$body['likes'].'</td>';
                        $out .= '<td><i title="Peliculas en esta lista" class="fas fa-film"></i> '.$body['peliculas'].'</td>';
                    }
                    $out .= '<td><a class="btn btn-warning" href="playlist.php?id='.$clave.'">Ver lista</a></td>';
                    $out .= '</tr>';
                }
                $out .='</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>El usuario aún no ha creado listas de reproducción</p>";
            }
        }

        public function getWatchlist()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT *,DATE(fecha) as vista FROM watchlist WHERE usuario = '$this->username' ORDER BY fecha DESC";
            $result = mysqli_query($this->conn,$sql);
            if($result && $result->num_rows > 0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['vista']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a onclick="addWatched('."'".$data['pelicula']."'".')" title="Marcar como vista"><i class="fas fa-check-square"></i></a></td>';
                        $out.= '<td><a data-toggle="modal" data-target="#exampleModal" onclick="unwatch('."'".$data['pelicula']."'".')" title="Quitar de la lista"><i class="fas fa-eye-slash"></i></a></td>';
                    }
                    $out .= '<td><a class="btn btn-warning" href="movie.php?id='.$data['pelicula'].'">Ver película</a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>El usuario aún no ha agregado películas por ver.</p>";
            }
        }

        public function getFavorites()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT *, DATE(fecha) as vista FROM favoritas WHERE usuario = '$this->username' ORDER BY fecha DESC";
            $result = mysqli_query($this->conn,$sql);
            if($result && $result->num_rows > 0)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['vista']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a data-toggle="modal" data-target="#exampleModal" onclick="unfavorite('."'".$data['pelicula']."'".')" title="Quitar de la lista"><i class="fas fa-heart-broken"></i></a></td>';
                    }
                    $out .= '<td><a class="btn btn-warning" href="movie.php?id='.$data['pelicula'].'">Ver película</a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>El usuario aún no ha agregado películas favoritas.</p>";
            }
        }

        public function getPlaylist($id)
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            $sql = "SELECT * FROM playlist WHERE creador = '$this->username'";
            $result = mysqli_query($conn, $sql);
            $out = '<li><a class="dropdown-item bg-light" href="new-playlist.php"><i class="fas fa-plus-circle"></i>Nueva</a></li>' ;
            if($result)
            {
                $out .= '<div class="dropdown-divider"></div>';
                while($data = mysqli_fetch_assoc($result))
                {
                    $out .= '<li><a class="dropdown-item bg-light" onclick="addToPlaylist('."'".$id."','".$data['clave']."'".')">
                    '.$data['nombre'].'</a></li>';
                }
            }
            return $out;
        }
    }
