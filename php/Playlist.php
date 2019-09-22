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
                $sql = "SELECT pelicula FROM playlist_peliculas WHERE playlist = $this->clave";
                $result = mysqli_query($conn,$sql);
                if($result && $result->num_rows > 0)
                {
                    $movies = array();
                    for($i = 0; $i<$result->num_rows; $i++)
                    {
                        $data = mysqli_fetch_array($result);
                        $movies[$i] = $data['pelicula'];
                    }
                    $this->getOMDBData();
                }   
                else 
                {
                    $movies = null;
                }
            }
            else 
            {
                $this->isReal = false;
            }
        }

        private function getOMDBData()
        {
            
        }

        public function exists()
        {
            return $this->isReal;
        }
    }
?>