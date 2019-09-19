<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');
    $movie = $_POST['movie'];
    $user = $_SESSION['username'];
    $sql = "DELETE FROM vistas WHERE pelicula = '$movie' AND usuario = '$user'";
    mysqli_query($conn,$sql) or die('"query"');
    echo json_encode("ok");
?>