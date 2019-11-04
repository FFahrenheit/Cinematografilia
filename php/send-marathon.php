<?php 
    require_once('Connection.php');
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $marathon = $_POST['marathon'];

    $sql = "UPDATE maraton SET estado = 'revision' WHERE clave = $marathon";
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