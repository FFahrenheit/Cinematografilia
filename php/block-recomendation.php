<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $movie = $_POST['movie'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO recomendacion_bloqueo(usuario, pelicula) VALUES ('$user','$movie')";
    $result = mysqli_query($conn,$sql) or die("3");
    if($result)
    {
        $sql = "DELETE FROM recomendacion WHERE receptor = '$user' AND pelicula = '$movie'";
        mysqli_query($conn,$sql);
        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?>