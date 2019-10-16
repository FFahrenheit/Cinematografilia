<?php
    include_once('Connection.php');
    session_start();
    $user = $_SESSION['username'];
    $friend = $_POST['friend'];
    if(strtolower($user) == strtolower($friend))
    {
        echo json_encode("4");
        return;
    }
    $temp = new Connection();
    $conn = $temp->getConnection() or die('"0"');

    $sql = "SELECT * FROM usuario WHERE username = '$friend'";
    $result = mysqli_query($conn,$sql) or die('"-1"');
    if($result && $result->num_rows>0)
    {
        $sql = "SELECT  * FROM bloqueo WHERE bloqueado = '$user' AND usuario = '$friend'";
        $result = mysqli_query($conn,$sql);
        if($result && $result->num_rows==0)
        {
            $sql = "SELECT * FROM solicitud WHERE receptor = '$user' AND emisor = '$friend'
            OR receptor = '$friend' AND emisor = '$user'";
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows>0)
            {
                echo json_encode("3");
            }
            else 
            {
                $sql = "INSERT INTO solicitud(emisor,receptor) VALUES ('$user','$friend')";
                $result = mysqli_query($conn, $sql) or die('"-1"');
                echo json_encode("5");
            }
        }
        else 
        {
            echo json_encode("2");
        }
    }
    else 
    {
        echo json_encode("1");
    }
?>