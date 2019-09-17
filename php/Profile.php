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
            $data = "<td height='40' width='40'><div><a style='color: white;' href='movie.php?id$id'><img src='".$json['Poster']."'></a></td>";
            $data .= "<td><a style='color: white;' href='movie.php?id$id'>".$json['Title']."</a></td>";
            $data .= "<td>".$json['Year']."</td>";
            return $data; 
        }

        public function getWatchlist()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT * FROM watchlist WHERE usuario = '$this->username' ORDER BY fecha DESC";
            $result = mysqli_query($this->conn,$sql);
            if($result && $result->num_rows > 0)
            {
                $out = '<table class ="table table-hover sa_table table-dark><tbody>"';
                while($data = mysqli_fetch_array($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['fecha']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a title="Marcar como vista" onclick="addWatched('.$data['pelicula'].')"><i class="fas fa-check-square"></i></a></td>';
                        $out.= '<td><a title="Quitar de la lista"><i class="fas fa-trash"></i></a></td>';
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

        public function getFavorites()
        {
            $temp = new Connection();
            $this->conn = $temp->getConnection();
            $sql = "SELECT * FROM favoritas WHERE usuario = '$this->username' ORDER BY fecha DESC";
            $result = mysqli_query($this->conn,$sql);
            if($result && $result->num_rows > 0)
            {
                $out = '<table class ="table table-hover sa_table table-dark><tbody>"';
                while($data = mysqli_fetch_array($result))
                {
                    $out .= '<tr>';
                    $out .= $this->getMovieRow($data['pelicula']);
                    $out .= "<td>".$data['fecha']."</td>";
                    if($this->user == $this->username)
                    {
                        $out.= '<td><a title="Quitar de la lista"><i class="fas fa-trash"></i></a></td>';
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
    }
?>