<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $marathon = $_POST['marathon'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO maraton_asistencia(maraton,usuario) VALUES ($marathon,'$user')";

    mysqli_query($conn,$sql) or die('"query"');
    echo json_encode("ok");
?>