<?php 
    require_once('Connection.php');
    session_start();
    $cn = new Connection();

    $conn = $cn->getConnection() or die('"0"');

    $user = $_SESSION['username'];

    $nombre = addslashes($_GET['name']);
    $descr = addslashes($_GET['description']);


    $sql = "INSERT INTO playlist (nombre, descripcion, creador) VALUES 
    ('$nombre','$descr','$user')";
        mysqli_query($conn,$sql) or die('"1"');

    if(isset($_GET['id']))
    {
        $movie = $_GET['id'];
        $sql = "INSERT INTO playlist_peliculas(playlist,pelicula) VALUES ('$conn->insert_id','$movie')";
        mysqli_query($conn,$sql);
    }

    echo json_encode("2");
?>