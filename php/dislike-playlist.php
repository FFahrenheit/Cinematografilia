<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $playlist = $_POST['playlist'];

    $sql = "DELETE FROM playlist_likes WHERE usuario='$user' AND playlist = $playlist";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
