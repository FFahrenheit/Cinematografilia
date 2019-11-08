<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $marathon = $_POST['marathon'];
    $user = $_SESSION['username'];

    $sql = "DELETE FROM maraton_asistencia WHERE maraton = $marathon && usuario = '$user'";

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