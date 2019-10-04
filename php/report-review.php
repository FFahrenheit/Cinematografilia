<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $review = $_POST['arg'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO review_reporte(razon, review) VALUES ('$reason',$review)";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
