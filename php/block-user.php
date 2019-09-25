<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $friend = $_POST['user'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO bloqueo(usuario, bloqueado) VALUES ('$user','$friend')";
    $result = mysqli_query($conn,$sql) or die("query");
    if($result)
    {
        echo json_encode("ok");
    }
    else 
    {
        echo json_encode("error");
    }
?>