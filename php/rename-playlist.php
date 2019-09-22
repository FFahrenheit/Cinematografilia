<?php 
    require_once('Connection.php');
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $playlist = $_POST['playlist'];
    $title = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE playlist SET nombre = '$title', descripcion = '$description' WHERE clave = $playlist";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
