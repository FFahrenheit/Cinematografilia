<?php 
    include_once("Connection.php");
    class Admin
    {
        public $isAdmin;

        public function __construct()
        {
            $this->isAdmin = isset($_SESSION['username']) && $_SESSION['username']=='admin';
        }

        public function getReports()
        {

        }
    }
?>