<?php
    require_once('Connection.php');
    $temp = new Connection();
    $conn = $temp->getConnection();
    session_start();

    $friend = $_POST['friend'];
    $user = $_SESSION['username'];
    $text = addslashes($_POST['text']);

    $sql = "INSERT INTO chat(emisor,receptor,mensaje) VALUES 
    ('$user','$friend','$text')";
    $result = mysqli_query($conn,$sql) or die('"0"');
    echo json_encode("ok");
?>