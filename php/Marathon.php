<?php 
    include_once('Connection.php');

    class Marathon
    {
        public $user="";
        public $visitor;

        public function __construct()
        {
            if(isset($_SESSION['username']))
            {
                $this->user = $_SESSION['username'];
                $this->visitor=false;
            }
            else 
            {
                $this->visitor = true;
            }
        }

        public function getActiveMarathons()
        {
            if($this->visitor)
            {
                return "<a href='login.php'><h4>Inicie sesión para entrar en maratones</h4></a>";
            }
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT *,
            (SELECT COUNT(*) FROM maraton_peliculas WHERE maraton = maraton.clave) as cont,
            (SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = maraton.clave) as asistencia
            FROM maraton WHERE estado = 'aceptado' AND DATE(NOW())<= fin AND 
            clave IN (SELECT maraton FROM maraton_asistencia WHERE usuario = '$this->user')";

            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $out = "";
                $out = '<p>Lista de maratones activos o por activarse</p><table class ="table table-hover sa_table"><tbody>';
                $out .= '<thead><tr><th>Nombre</th><th>Películas</th><th>Descripción</th><th>Anfitrión</th><th>Empieza</th><th>Termina</th>
                <th>Asistentes</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= "<tr>";

                    $out .= '<td>'.$data['nombre'].'</td>';
                    $out .= '<td>'.$data['cont'].'</td>';
                    $out .= '<td>'.$data['descripcion'].'</td>';
                    $out .= '<td><a class="text-light" href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td>'.$data['inicio'].'</td>';
                    $out .= '<td>'.$data['fin'].'</td>';
                    $out .= '<td>'.$data['asistencia'].'</td>';
                    $out .= '<td><a style="text-decoration:none;" href="marathon.php?clave='.$data['clave'].'"class="btn btn-warning text-dark">Ver progreso</a></td>';

                    $out .= "</tr>";
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>Por el momento no tiene maratones activos</h4>";
            }
        }

        public function getMarathons()
        {
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT *,
            (SELECT COUNT(*) FROM maraton_peliculas WHERE maraton = maraton.clave) as cont,
            (SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = maraton.clave) as asistencia 
            FROM maraton WHERE estado = 'aceptado' AND DATE(NOW())<= inicio AND 
            clave NOT IN (SELECT maraton FROM maraton_asistencia WHERE usuario = '$this->user')";

            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $out = "";
                $out = '<p>Lista de maratones a los que puede inscribirse</p><table class ="table table-hover sa_table"><tbody>';
                $out .= '<thead><tr><th>Nombre</th><th>Películas</th><th>Descripción</th><th>Anfitrión</th><th>Empieza</th><th>Termina</th>
                <th>Asistentes</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= "<tr>";

                    $out .= '<td>'.$data['nombre'].'</td>';
                    $out .= '<td>'.$data['cont'].'</td>';
                    $out .= '<td>'.$data['descripcion'].'</td>';
                    $out .= '<td><a class="text-light" href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td>'.$data['inicio'].'</td>';
                    $out .= '<td>'.$data['fin'].'</td>';
                    $out .= '<td>'.$data['asistencia'].'</td>';
                    $out .= (!$this->visitor)?
                    '<td><a style="text-decoration:none;" href="marathon.php?clave='.$data['clave'].'"class="btn btn-warning text-dark">Detalles</a></td>'
                    :
                    '<td><a style="text-decoration:none;" href="login.php"class="btn btn-warning text-dark">Inicie sesión para entrar</a></td>';

                    $out .= "</tr>";
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>Por el momento no hay maratones a los cuales unirse</h4>";
            }
        }

        public function getFeedback()
        {
            if($this->visitor)
            {
                return "<a href='login.php'><h4>Inicie sesión para dar su feedback de maratones</h4></a>";
            }
            $temp = new Connection();
            $conn = $temp->getConnection();

            $sql = "SELECT *,
            (SELECT COUNT(*) FROM maraton_peliculas WHERE maraton = maraton.clave) as cont,
            (SELECT COUNT(*) FROM maraton_asistencia WHERE maraton = maraton.clave) as asistencia,
            DATEDIFF(DATE(NOW()),maraton.fin) as diff
            FROM maraton WHERE estado = 'aceptado' AND DATE(NOW())> fin AND 
            clave IN (SELECT maraton FROM maraton_asistencia WHERE usuario = '$this->user')";

            $rs = mysqli_query($conn,$sql);

            if($rs && $rs->num_rows>0)
            {
                $out = "";
                $out = '<p>Lista de acabados</p><table class ="table table-hover sa_table"><tbody>';
                $out .= '<thead><tr><th>Nombre</th><th>Películas</th><th>Descripción</th><th>Anfitrión</th><th>Empieza</th><th>Termina</th>
                <th>Asistentes</th><th>&nbsp;</th></tr></thead>';
                while($data = mysqli_fetch_assoc($rs))
                {
                    $out .= "<tr>";

                    $out .= '<td>'.$data['nombre'].'</td>';
                    $out .= '<td>'.$data['cont'].'</td>';
                    $out .= '<td>'.$data['descripcion'].'</td>';
                    $out .= '<td><a class="text-light" href="profile.php?user='.$data['creador'].'">'.$data['creador'].'</a></td>';
                    $out .= '<td>'.$data['inicio'].'</td>';
                    $out .= '<td>'.$data['fin'].'</td>';
                    $msg = $data['diff'] > 7 ? "Ver detalles" : "Dar feedback";
                    $out .= '<td>'.$data['asistencia'].'</td>';
                    $out .= '<td><a style="text-decoration:none;" href="marathon.php?clave='.$data['clave'].'"class="btn btn-warning text-dark">'.$msg.'</a></td>';

                    $out .= "</tr>";
                }
                $out .= '</tbody></table>';
                return $out;
            }
            else 
            {
                return "<h4>Por el momento no tiene maratones finalizados</h4>";
            }
        }
    }
?>