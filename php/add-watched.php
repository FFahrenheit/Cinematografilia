<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $liked = (isset($_POST['liked']))? "1" : "0";
    $movie = $_POST['movie'];
    $user = $_SESSION['username'];
    $date = $_POST['fecha'];

    $sql ="DELETE FROM watchlist WHERE usuario = '$user' AND pelicula = '$movie'";
    mysqli_query($conn,$sql);

    $sql = "INSERT INTO vistas(usuario, pelicula, fecha) VALUES ('$user','$movie' , (SELECT CONVERT('$date',DATETIME)))";

    mysqli_query($conn,$sql) or die('"1"');
    echo json_encode("2");

    if(isset($_POST['foo']))
    {
        $sql = "DELETE FROM watchlist WHERE pelicula = '$movie' AND usuario = '$user'";
        mysqli_query($conn, $sql);
    }
?>