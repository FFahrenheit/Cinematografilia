<?php 
    include 'Connection.php';
    $obj = new Connection();
    $connection = $obj->getConnection() or die('"1"');
    $user = $_POST['username'];

    $sql = "SELECT email FROM usuario WHERE username = '$user'";

    $result = mysqli_query($connection,$sql) or die('"1"');

    if($result && $result->num_rows>0)
    {
        $pass = substr(md5(rand()),-12);
        $data = mysqli_fetch_assoc($result);

        $title="Recuperación de contraseña SpoilerAlert!";
        $body = "<h4>Se ha solicitado la recuperación de la cuenta asociada a este correo</h4><br>
        <p>Tu nueva contraseña es <strong>$pass</strong></p>. <p>Si no has solicitado la recuperación 
        de cuenta, ignora este mensaje</p>";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "From: diskman199@gmail.com";

        if(mail($data['email'],$title,$body,$headers))
        {
            $sql = "UPDATE usuario SET temporal = '$pass' WHERE username='$user'";
            mysqli_query($connection,$sql) or die('"4"');
            echo json_encode("5");
        }
        else 
        {
            echo json_encode("3");
        }
    }
    else 
    {
        echo json_encode("2");
    }
?>