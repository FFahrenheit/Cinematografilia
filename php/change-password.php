<?php 
    include 'Connection.php';
    $c = new Connection();
    session_start();
    $connection = $c->getConnection() or die ('"0"');

    $oPass = $_POST['old_password'];
    $pass = $_POST['password'];
    $user = $_SESSION['username'];

    $sql = "SELECT username FROM usuario WHERE username = '$user' AND AES_ENCRYPT('$oPass','5p01l3r') = password";

    $result = mysqli_query($connection,$sql) or die('"1"');

    if($result->num_rows>0)
    {
        if($pass != $oPass)
        {
            $sql = "UPDATE usuario SET password = AES_ENCRYPT('$pass','5p01l3r') WHERE username = '$user'";
            mysqli_query($connection,$sql) or die('"4"');
            echo json_encode("5");
        }
        else 
        {
            echo json_encode("3");
        }
    }
    else 
    {
        echo json_encode("2");
    }
?>