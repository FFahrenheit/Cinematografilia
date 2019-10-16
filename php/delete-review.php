<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $arg = $_POST['arg'];

    $sql = "DELETE FROM review WHERE clave = $arg";

    mysqli_query($conn,$sql) or die('"1"');

    if($conn->affected_rows>0){
        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?> 
