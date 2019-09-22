<?php 
    require_once('main.php');
    class Profile
    {
        public $conn;
        public $username;
        public $image;
        public $date;
        public $APIKey; 
        public $exists = true;
        public $user;

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
                $data = mysqli_fetch_array($result);
                $this->image = $data['imagen'];
                $this->date = $data['date'];
            }
            else 
            {
                $this->exists = false;
            }
        }

        public function getUser()
        {
            return ($this->username != $this->user)? $this->username : $this->username.' <a href="configure.php" title="Configurar"><i class="fas fa-cog"></i></a>';
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
                while($data = mysqli_fetch_array($result))
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
                return "<span>El usuario aún no ha agregado películas vistas.</span>";
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
                while($data = mysqli_fetch_array($result))
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
                        $body = mysqli_fetch_array($rs);
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
                return "<span>El usuario aún no ha creado listas de reproducción</span>";
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
                while($data = mysqli_fetch_array($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['vista']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a data-toggle="modal" data-target="#exampleModal" onclick="watchMovie('."'".$data['pelicula']."'".')" title="Marcar como vista" onclick="addWatched('.$data['pelicula'].')"><i class="fas fa-check-square"></i></a></td>';
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
                return "<span>El usuario aún no ha agregado películas por ver.</span>";
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
                while($data = mysqli_fetch_array($result))
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
                return "<span>El usuario aún no ha agregado películas favoritas.</span>";
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
                while($data = mysqli_fetch_array($result))
                {
                    $out .= '<li><a class="dropdown-item bg-light" onclick="addToPlaylist('."'".$id."','".$data['clave']."'".')">
                    '.$data['nombre'].'</a></li>';
                }
            }
            return $out;
        }
    }
