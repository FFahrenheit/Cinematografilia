<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $key = $_POST['key'];
    $status = $_POST['status'];

    $sql = "UPDATE maraton SET estado = '$status' WHERE clave = '$key'";
    $result = mysqli_query($conn,$sql) or die('"1"');
    if($result && mysqli_affected_rows($conn) > 0)
    {
        // $msg = ($status == 'rechazado') ? 
        // "El maratón ha sido rechazado por los siguientes motivos: ".$_POST['reason']
        // :
        // "Tu maratón ha sido aceptado";

        // $sql = "INSERT INTO chat()";

        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?>