<?php 
    require_once('Connection.php');
    class Profile
    {
        public $conn;
        public $username;
        public $image;
        public $date;
        public $exists = true;

        public function __construct($id)
        {
            $temp = new Connection();
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
    }
?>