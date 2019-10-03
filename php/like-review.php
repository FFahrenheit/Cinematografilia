<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $review = $_POST['review'];

    $sql = "INSERT INTO review_like(usuario, review) VALUES ('$user',$review)";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
