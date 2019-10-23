<?php 
    session_start();
    include_once('Connection.php');
    if(!isset($_SESSION['temporal']))
    {
        echo json_encode("3");
        die();
    }

    $c = new Connection();
    $pass = $_POST['pass'];
    $connection = $c->getConnection() or die ('"0"');

    $user = $_SESSION['username'];

    $sql = "UPDATE usuario SET password = AES_ENCRYPT('$pass','5p01l3r') WHERE username = '$user'";

    $result = mysqli_query($connection,$sql) or die('"1"');

    if($result && mysqli_affected_rows($connection)>0)
    {
        $_SESSION['temporal'] = "ipsum";
        echo json_encode("2");
    }
    else 
    {
        echo json_encode("1");
    }
?>