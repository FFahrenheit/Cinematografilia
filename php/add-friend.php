<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"connection"');

    $friend = $_POST['user'];
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM solicitud WHERE receptor = '$user' AND emisor = '$friend'";
    $result = mysqli_query($conn,$sql);
    if($result && $result->num_rows > 0)
    {
        echo json_encode("error");
        die();
    }

    $sql = "INSERT INTO solicitud(emisor,receptor) VALUES ('$user','$friend')";

    mysqli_query($conn,$sql) or die('"query"');
    echo json_encode("ok");
?>