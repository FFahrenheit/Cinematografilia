<?php 
    class Connection
    {
        private $server;
        private $user;
        private $pass;
        private $db;
        private $connection;

        public function __construct()
        {
            $this->server = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = "spoileralert";
        }

        public function getConnection()
        {
            $this->connection = mysqli_connect($this->server, $this->user, $this->pass, $this->db) or die('"connection"');
            mysqli_set_charset($this->connection,"utf-8");
            return $this->connection;
        }

        public function __destruct()
        {
            if($this->connection)
            {
                mysqli_close($this->connection);
            }
        }

        public function getCount($_con, $_query)
        {
            $result = mysqli_query($_con,$_query);
            if($result)
            {
                $data = mysqli_fetch_array($result);
                return $data[0];
            }
            else 
            {
                return -1;
            }
        }
    }
?>