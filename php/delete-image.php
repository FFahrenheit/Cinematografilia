<?php 
    include 'Connection.php';
    session_start();
    $user = $_SESSION['username'];
    $c = new Connection();
    $connection = $c->getConnection() or die('"0"');

    $query = "UPDATE usuario SET imagen = '../../img/default-profile.png' WHERE username = '$user'";
    mysqli_query($connection,$query) or die('"0"');
    echo json_encode("1");
    die();
?>