<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $marathon = $_POST['marathon'];
    $user = $_SESSION['username'];
    $movie = $_POST['movie'];

    $sql = "INSERT INTO maraton_progreso(maraton,usuario,pelicula) VALUES ($marathon,'$user','$movie')";

    mysqli_query($conn,$sql) or die('"query"');
    echo json_encode("ok");
?>