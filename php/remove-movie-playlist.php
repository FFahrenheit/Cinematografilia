<?php 
    require_once('Connection.php');
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $playlist = $_POST['playlist'];
    $movie = $_POST['movie'];

    $sql = "DELETE FROM playlist_peliculas WHERE pelicula = '$movie' AND playlist = $playlist";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
