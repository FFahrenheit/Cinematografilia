<?php 
    include 'Connection.php';
    $c = new Connection();
    $connection = $c->getConnection() or die ('"1"');

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT email FROM usuario WHERE username = '$user' AND AES_ENCRYPT('$pass','5p01l3r') = password";

    $result = mysqli_query($connection,$sql) or die('"2"');

    if($result->num_rows>0)
    {
        session_start();
        $row = mysqli_fetch_array($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $user;
        echo json_encode("4");
    }
    else 
    {
        echo json_encode("3");
    }
?>