<?php 
    require_once('Connection.php');
    class Playlist
    {
        public $clave;
        public $owner;
        public $date;
        public $name;
        public $APIKey = "b27f9641";
        public $movies; 
        public $isReal = true;
        public $likes;
        public $user;
        public $mosaic;
        public $list=""; 
        public $movieCount;
        public $description;
        public $liked;

        public function __construct($key,$user)
        {
            $this->clave = $key;
            $this->user = $user;
            $temp = new Connection();
            $conn = $temp->getConnection();
            $sql = "SELECT playlist.*, COUNT(playlist_likes.usuario) AS likes, DATE(playlist.fecha) AS creado
            FROM playlist,playlist_likes WHERE clave = $this->clave AND playlist.clave = playlist_likes.playlist";
            if($result = mysqli_query($conn,$sql))
            {
                $data = mysqli_fetch_assoc($result);
                $this->owner = $data['creador'];
                $this->name = $data['nombre'];
                $this->date = $data['creado'];
                $this->likes = $data['likes'];
                $this->description = $data['descripcion'];
                $sql = "SELECT pelicula FROM playlist_peliculas WHERE playlist = $this->clave ORDER BY RAND()";
                $result = mysqli_query($conn,$sql);
                if($result && $result->num_rows > 0)
                {
                    $this->movieCount = $result->num_rows;
                    $this->movies = array();
                    for($i = 0; $i<$result->num_rows; $i++)
                    {
                        $data = mysqli_fetch_assoc($result);
                        $this->movies[$i] = $data['pelicula'];
                    }
                    $this->getOMDBData();
                    $sql = "SELECT * FROM playlist_likes WHERE playlist = $this->clave AND usuario = '$this->user'";
                    $result = mysqli_query($conn, $sql);
                    $this->liked = $result && $result->num_rows>0;
                }   
                else 
                {
                    $this->mosaic = '<div class="no-mosaic"><img src="../../img/logo.png" alt="Placeholder"></div>';
                    $this->movies = null;
                }
            }
            else 
            {
                $this->isReal = false;
            }
        }

        public function getOwner()
        {
            return '<a href="profile.php?user='.$this->owner.'"><i class="fas fa-user"></i>'.$this->owner.'</a>';
        }

        private function getOMDBData()
        {
            $i = 0;
            $this->mosaic = '<div class="mosaic" style="cursor: pointer;">';
            foreach($this->movies as $movie)
            {
                $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=".$movie;
                $content = file_get_contents($url);
                $body = json_decode($content,true);
                if($i<4)
                {
                    $this->mosaic .= '<img src="'.$body['Poster'].'">';
                    $i++;
                }
            }
            if($i<4)
            {
                for($j = $i; $j<4; $j++)
                {
                    $this->mosaic .= '<img src="../../img/poster.jpg" alt="Placeholder">';
                }
            }
            $this->mosaic .= "</div>";
        }

        public function getPoster()
        {
            return $this->mosaic;
        }

        public function exists()
        {
            return $this->isReal;
        }

        public function getName()
        {
            $args = '"'.$this->clave.'","'.$this->name.'","'.$this->description.'"';
            return ($this->user == $this->owner)? 
            $this->name."<a class='sa_table' 
            onclick='showPlaylistForm(".$args.");'>".'<i title="Editar" class="fas fa-pencil-alt"></i>'."</a>" 
            : $this->name;
        }

        public function getMovies()
        {
            if($this->movies)
            {
                $out = '<table class ="table table-hover sa_table"><tbody>';
                foreach($this->movies as $movie)
                {
                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=".$movie;
                    $content = file_get_contents($url);
                    $data = json_decode($content,true);
                    $out .= '<tr>';
                    $out .= "<td height='40' width='40'><div><a style='color: white;' href='movie.php?id=$movie'><img src='".$data['Poster']."'></a></td>";
                    $out .= "<td><a style='color: white;' href='movie.php?id=$movie'>".$data['Title']." (".$data['Year'].")</a></td>";
                    if($this->owner == $this->user)
                    {
                        $out .= '<td><a class="sa_table" onclick="deleteMovie('."'".$movie."','".$this->clave."'".')"><i title="Quitar de la lista" class="fas fa-minus-square"></i></a></td>';
                    }
                    $out .= '<td><a class="btn btn-warning text-dark" href="movie.php?id='.$movie.'">Ver película</a></td>';
                    $out .= '</tr>';
                }
                $out .= '</tbody></table>';
                return $out;
            }
            return "<p>La lista de reproducción está vacía</p>";
        }

        public function doILikeIt()
        {
            return $this->liked ? 
            '<a class="btn btn-warning text-dark" onclick="unlike('."'".$this->clave."'".')"><i class="fas fa-thumbs-down"></i> Ya no me gusta</a>'
            :'<a class="btn btn-warning text-dark" onclick="like('."'".$this->clave."'".')"><i class="fas fa-thumbs-up"></i> Me gusta esta lista</a>';
        }
    }
?>