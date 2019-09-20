<?php 
    require_once('Connection.php');
    session_start();
    $cn = new Connection();

    $conn = $cn->getConnection() or die('"0"');

    $user = $_SESSION['username'];

    $nombre = $_GET['name'];
    $descr = $_GET['description'];


    $sql = "INSERT INTO playlist (nombre, descripcion, creador) VALUES 
    ('$nombre','$descr','$user')";

    mysqli_query($conn,$sql) or die('"1"');
    echo json_encode("2");
?>