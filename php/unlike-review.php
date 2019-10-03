<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $review = $_POST['review'];

    $sql = "DELETE FROM review_like WHERE usuario = '$user' AND review = $review";

    mysqli_query($conn,$sql) or die('"1"');

    if($conn->affected_rows>0){
        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?> 
