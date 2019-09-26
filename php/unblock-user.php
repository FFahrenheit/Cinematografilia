<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $friend = $_POST['user'];
    $user = $_SESSION['username'];

    $sql = "DELETE FROM bloqueo WHERE usuario  = '$user' AND bloqueado = '$friend'";
    $result = mysqli_query($conn,$sql) or die("query");
    if($result && mysqli_affected_rows($conn)>0)
    {
        echo json_encode("ok");
    }
    else 
    {
        echo json_encode("error");
    }
?>