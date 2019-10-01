<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $movie = $_POST['movie'];
    $calification = $_POST['calification'];

    $sql = "INSERT INTO calificacion(pelicula, usuario, valor) VALUES ('$movie','$user',$calification)
    ON DUPLICATE KEY UPDATE valor = $calification";


    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
