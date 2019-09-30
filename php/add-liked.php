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

    $sql = "INSERT INTO likes(pelicula,usuario) VALUES ('$movie','$user')";

    if(mysqli_query($conn,$sql))
    {
        echo json_encode("3");
    }
    else 
    {
        echo json_encode("2");
    }
?>