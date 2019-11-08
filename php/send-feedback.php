<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $marathon = $_POST['marathon'];
    $user = $_SESSION['username'];
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO maraton_feedback(maraton,usuario,texto) VALUES ($marathon,'$user','$feedback')";

    mysqli_query($conn,$sql) or die('"query"');
    echo json_encode("ok");
?>