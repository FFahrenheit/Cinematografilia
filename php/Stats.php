<?php 
    include_once("Connection.php");

    function addTo(&$string,$concat,$begin,$end,$isNumber)
    {
        if(!$isNumber)
        {
            $concat = "'".$concat."'";
        }
        if($begin && $end)
        {
            $string .= "[".$concat."]";
        }
        else if($begin)
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
        public $labels="";
        public $watched="";
        public $liked="";
        public $APIKey = "b27f9641";

        public function __construct($username="")
        {
            $this->user = $username;
            if($username!="")
            {
                $this->loadData();
            }
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

        public function getMostWatchedWeekly()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * , COUNT(pelicula) as cont FROM vistas 
            WHERE WEEK(fecha) = WEEK(NOW()) AND YEAR(NOW()) = YEAR(fecha) 
            GROUP BY pelicula ORDER BY cont DESC,pelicula ASC LIMIT 10";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $i = 0;
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= '<tr>';
                    switch($i)
                    {
                        case 0:
                            $out .= '<td><i title="Primer lugar"class="fas fa-trophy"></i></td>';
                            break;
                        case 1:
                            $out .= '<td><i title="Segundo lugar" class="fas fa-medal"></i></td>';
                            break;
                        case 2:
                            $out .= '<td><i title="Tercer lugar"class="fas fa-award"></i></td>';
                            break;
                        default:
                            $out .= "<td>&nbsp;</td>";
                            break;
                    }

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['pelicula'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['pelicula']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $ad = $data['cont']==1 ? "vista." : "vistas.";

                    $out .= "<td>".$data['cont']." $ad</td>";

                    $out .= '</tr>';
                    $i++;
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay resultados reportados esta semana aún</p>";
            }
        }

        public function getMostLikedWeekly()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * , COUNT(pelicula) as cont FROM likes 
            WHERE WEEK(fecha) = WEEK(NOW()) AND YEAR(NOW()) = YEAR(fecha) 
            GROUP BY pelicula ORDER BY cont DESC,pelicula ASC LIMIT 10";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $i = 0;
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= '<tr>';
                    switch($i)
                    {
                        case 0:
                            $out .= '<td><i title="Primer lugar"class="fas fa-trophy"></i></td>';
                            break;
                        case 1:
                            $out .= '<td><i title="Segundo lugar" class="fas fa-medal"></i></td>';
                            break;
                        case 2:
                            $out .= '<td><i title="Tercer lugar"class="fas fa-award"></i></td>';
                            break;
                        default:
                            $out .= "<td>&nbsp;</td>";
                            break;
                    }

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['pelicula'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['pelicula']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $ad = $data['cont']==1 ? "me gusta." : "me gustas.";

                    $out .= "<td>".$data['cont']." $ad</td>";

                    $out .= '</tr>';
                    $i++;
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay resultados reportados esta semana aún</p>";
            }
        }

        public function getMostWatchedGlobal()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * , COUNT(pelicula) as cont FROM vistas 
            GROUP BY pelicula ORDER BY cont DESC,pelicula ASC LIMIT 10";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $i = 0;
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= '<tr>';
                    switch($i)
                    {
                        case 0:
                            $out .= '<td><i title="Primer lugar"class="fas fa-trophy"></i></td>';
                            break;
                        case 1:
                            $out .= '<td><i title="Segundo lugar" class="fas fa-medal"></i></td>';
                            break;
                        case 2:
                            $out .= '<td><i title="Tercer lugar"class="fas fa-award"></i></td>';
                            break;
                        default:
                            $out .= "<td>&nbsp;</td>";
                            break;
                    }

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['pelicula'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['pelicula']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $ad = $data['cont']==1 ? "vista." : "vistas.";

                    $out .= "<td>".$data['cont']." $ad</td>";

                    $out .= '</tr>';
                    $i++;
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay resultados reportados esta semana aún</p>";
            }
        }

        public function getMostLikedGlobal()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT * , COUNT(pelicula) as cont FROM likes 
            GROUP BY pelicula ORDER BY cont DESC,pelicula ASC LIMIT 10";

            $rs = mysqli_query($conn,$sql);
            if($rs && $rs->num_rows>0)
            {
                $i = 0;
                $out = '<table class ="table table-hover sa_table"><tbody>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= '<tr>';
                    switch($i)
                    {
                        case 0:
                            $out .= '<td><i title="Primer lugar"class="fas fa-trophy"></i></td>';
                            break;
                        case 1:
                            $out .= '<td><i title="Segundo lugar" class="fas fa-medal"></i></td>';
                            break;
                        case 2:
                            $out .= '<td><i title="Tercer lugar"class="fas fa-award"></i></td>';
                            break;
                        default:
                            $out .= "<td>&nbsp;</td>";
                            break;
                    }

                    $url = "http://www.omdbapi.com/?apikey=$this->APIKey&i=" . $data['pelicula'];
                    $content = file_get_contents($url);
                    $body = json_decode($content, true);

                    $hr = "<a style='color: white;' href = 'movie.php?id=".$data['pelicula']."'>";
                    $poster = ($body['Poster']=="N/A")? "../../img/poster.jpg" : $body['Poster'];
                    $out .= "<td>$hr<img src='".$poster."'></a></td>";
                    $out .= "<td>$hr".$body['Title']." (".$body['Year'].") </a></td>";
                    
                    $ad = $data['cont']==1 ? "me gusta." : "me gustas.";

                    $out .= "<td>".$data['cont']." $ad</td>";

                    $out .= '</tr>';
                    $i++;
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<p>No hay resultados reportados esta semana aún</p>";
            }
        }
    }
?>