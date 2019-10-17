<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $clave = $_POST['clave'];

    $sql = "DELETE FROM preguntas WHERE clave = $clave";
    // echo json_encode($sql);die();
    $result = mysqli_query($conn,$sql) or die("1");
    if($result && mysqli_affected_rows($conn)>0)
    {
        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?>