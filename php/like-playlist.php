<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $playlist = $_POST['playlist'];

    $sql = "SELECT  * FROM playlist WHERE clave = $playlist";
    $rs = mysqli_query($conn,$sql);
    if($rs)
    {
        $data = mysqli_fetch_assoc($rs);
        if($data['creador'] != $user)
        {
            $sql = "INSERT INTO playlist_likes(usuario, playlist) VALUES ('$user',$playlist)";

            mysqli_query($conn,$sql) or die('"1"');

            echo json_encode("2");
            die();
        }
        else 
        {
            echo json_encode("405");
        }
    }
    else 
    {
        echo json_encode("404");
    }
?> 
