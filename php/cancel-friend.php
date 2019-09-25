<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $friend = $_POST['user'];
    $user = $_SESSION['username'];

    $sql = "DELETE FROM solicitud WHERE emisor = '$user' AND receptor = '$friend'";

    mysqli_query($conn,$sql) or die('"query"');
    if(mysqli_affected_rows($conn)>0)
    {
        echo json_encode("ok");
    }
    else 
    {
        echo json_encode("query");
    }
?>