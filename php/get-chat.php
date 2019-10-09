<?php
    require_once('Connection.php');
    $temp = new Connection();
    $conn = $temp->getConnection();
    session_start();

    $friend = $_POST['friend'];
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM chat WHERE 
    emisor = '$user' AND receptor = '$friend'
    OR emisor = '$friend' AND receptor ='$user'
    ORDER BY fecha ASC";
    $result = mysqli_query($conn,$sql);
    if($result && $result->num_rows>0)
    {
        $out="";
        while($data = mysqli_fetch_assoc($result))
        {
            if($data['emisor'] == $user)
            {
                $out .= '<div class="balon1 p-2 m-0 position-relative" data-is="Usted - '.$data['fecha'].'">';
                $out .= '<a class="float-right">';
                $out .= addslashes($data['mensaje']);
                $out .= '</a></div>';
            }
            else 
            {
                $out .= '<div class="balon2 p-2 m-0 position-relative" data-is="'.$data['emisor'].' - '.$data['fecha'].'">';
                $out .= '<a class="float-left sohbet2">';
                $out .= addslashes($data['mensaje']);
                $out .= '</a></div>';
                if($data['visto'] == 0)
                {
                    $tmp = new Connection();
                    $con = $tmp->getConnection();
                    $key = $data['clave'];
                    $sql = "UPDATE chat SET visto = 1 WHERE clave = $key";
                    mysqli_query($con,$sql);
                }
            }
        }
        echo $out;
    }
    else 
    {
        echo "<p class='text-warning text-center'>No hay mensajes. Sé el primero en decir hola.</p>";
    }
?>