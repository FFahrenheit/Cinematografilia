<?php 
    include 'Connection.php';
    $c = new Connection();
    $connection = $c->getConnection() or die ('"1"');

    if(isset($_GET['username']))
    {
        $user = $_GET['username'];
        $pass = $_GET['password'];
    }
    else 
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];
    }

    $sql = "SELECT email FROM usuario WHERE username = '$user' AND AES_ENCRYPT('$pass','5p01l3r') = password";

    $result = mysqli_query($connection,$sql) or die('"2"');

    if($result->num_rows>0)
    {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $user;
        echo json_encode("4");
    }
    else 
    {
        $sql = "SELECT email FROM usuario WHERE username = '$user' AND temporal = '$pass'";
        $result = mysqli_query($connection,$sql) or die('"2"');
        if($result && $result->num_rows>0)
        {
            $row = mysqli_fetch_assoc($result);
            $sql = "UPDATE usuario SET temporal = NULL WHERE username = '$user'";
            mysqli_query($connection,$sql);
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $user;
            echo json_encode("5");
        }
        else 
        {
            echo json_encode("3");
        }
    }
?>