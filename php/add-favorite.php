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

    $sql = "SELECT COUNT(*) AS CONT FROM favoritas WHERE usuario = '$user'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        $body = mysqli_fetch_assoc($result);
        if($body['cont']>=10)
        {
            echo json_encode("4");
            die();
        }
    }
    
    $sql ="DELETE FROM watchlist WHERE usuario = '$user' AND pelicula = '$movie'";
    mysqli_query($conn,$sql);
    $sql = "INSERT INTO favoritas(pelicula,usuario) VALUES ('$movie','$user')";

    if(mysqli_query($conn,$sql))
    {
        echo json_encode("3");
    }
    else 
    {
        echo json_encode("2");
    }
?>