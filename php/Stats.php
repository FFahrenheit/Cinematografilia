<?php 
    include_once("Connection.php");

    function addTo(&$string,$concat,$begin,$end,$isNumber)
    {
        if(!$isNumber)
        {
            $concat = "'".$concat."'";
        }
        if($begin)
        {
            $string = "[".$concat;
        }
        else if($end)
        {
            $string .= ",".$concat."]";
        }
        else
        {
            $string .= ",".$concat;
        }
    }

    class Stats
    {
        public $user;
        public $labels="lol";
        public $watched="lol";
        public $liked="lol";

        public function __construct($username="")
        {
            $this->user = $username;
            $this->loadData();
        }

        public function loadData()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();
            
            $sql = "SELECT MONTH(origen) as mo, YEAR(origen) as yo, MONTH(NOW()) as mf,YEAR(NOW()) as yf  
            FROM usuario WHERE username = '$this->user'";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $data = mysqli_fetch_assoc($rs);
                $month = $data['mo'];
                $mo = $data['mo'];
                $yo = $data['yo'];
                $year = $data['yo'];
                $mf = $data['mf'];
                $yf = $data['yf'];
                while($year<$yf || ($year==$yf && $month <= $mf))
                {
                    $sql = "SELECT COUNT(vistas.pelicula) as vistas 
                    FROM vistas WHERE vistas.usuario = '$this->user' AND 
                    MONTH(vistas.fecha) = $month AND YEAR(vistas.fecha) = $year";

                    addTo($this->watched,
                                $temp->getCount($conn,$sql),
                                ($month==$mo && $year==$yo),
                                ($month==$mf && $year==$yf),
                                true);

                    $sql = "SELECT COUNT(likes.pelicula) as likes 
                    FROM likes WHERE likes.usuario = '$this->user' AND 
                    MONTH(likes.fecha) = $month AND YEAR(likes.fecha) = $year";

                    addTo($this->liked,
                                $temp->getCount($conn,$sql),
                                ($month==$mo && $year==$yo),
                                ($month==$mf && $year==$yf),
                                true);

                    $sql = "SELECT CONCAT(
                        MONTHNAME(CONCAT('$year-',$month,'-01')),
                        ' ', 
                        $year
                    )";

                    addTo($this->labels,
                                $temp->getCount($conn,$sql),
                                ($month==$mo && $year==$yo),
                                ($month==$mf && $year==$yf),
                                false);

                    if($month == 12)
                    {
                        $month = 1;
                        $year++;
                    }
                    else 
                    {
                        $month++;
                    }
                }
                // echo $this->labels;
                // echo $this->liked;
                // echo $this->watched;
            }
            else
            {
                echo "Ha ocurrido un error en la base de datos";
            }
        }
    }
?>