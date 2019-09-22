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
                $data = mysqli_fetch_array($result);
                $this->owner = $data['creador'];
                $this->name = $data['nombre'];
                $this->date = $data['creado'];
                $this->likes = $data['likes'];
                $this->description = $data['descripcion'];
                $sql = "SELECT pelicula FROM playlist_peliculas WHERE playlist = $this->clave";
                $result = mysqli_query($conn,$sql);
                if($result && $result->num_rows > 0)
                {
                    $this->movieCount = $result->num_rows;
                    $this->movies = array();
                    for($i = 0; $i<$result->num_rows; $i++)
                    {
                        $data = mysqli_fetch_array($result);
                        $this->movies[$i] = $data['pelicula'];
                    }
                    $this->getOMDBData();
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
            $this->mosaic = '<div class="mosaic">';
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
                    $this->mosaic .= '<img src="../../img/logo.png" alt="Placeholder">';
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
    }
?>