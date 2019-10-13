<?php 
    session_start();
    require_once('Connection.php');
    $movie = $_POST['movie'];
    if(isset($_SESSION['username']))
    {
        $user = $_SESSION['username'];
    }
    else 
    {
        echo json_encode("0");
        die();
    }

    $c = new Connection;
    $conn = $c->getConnection() or die('"1"');

    $sql = "SELECT * FROM vistas WHERE pelicula = '$movie' AND usuario = '$user'";
    $result = mysqli_query($conn,$sql);
    if($result && $result->num_rows > 0)
    {
        echo json_encode("3");
        return;
    }

    $sql = "INSERT INTO watchlist(pelicula,usuario) VALUES ('$movie','$user')";

    if(mysqli_query($conn,$sql))
    {
        echo json_encode("4");
        $sql = "DELETE FROM recomendacion WHERE pelicula = '$movie' AND receptor = '$user'";
        mysqli_query($conn,$sql);
    }
    else 
    {
        echo json_encode("2");
    }
?>