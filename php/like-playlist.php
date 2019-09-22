<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $playlist = $_POST['playlist'];

    $sql = "INSERT INTO playlist_likes(usuario, playlist) VALUES ('$user',$playlist)";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
