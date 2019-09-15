<?php 
    include 'Connection.php';
    session_start();
    $c = new Connection();
    $connection = $c->getConnection() or die('"0"');

    if($_FILES['image']['tmp_name']!='')
    {
        $file = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $format = substr($name,strrpos($name,'.'));
    }
    else
    {
        echo '"1"';
        die();
    }

    if(isset($_SESSION['username']))
    {
        $user = $_SESSION['username'];
        $location = "../img/profiles/".$_SESSION['username'].$format;
    }
    else 
    {
        echo '"2"';
        die();
    }

    $query = "UPDATE usuario SET imagen = '../$location' WHERE username = '$user'";
    mysqli_query($connection,$query) or die('"3"');
    move_uploaded_file($file,$location);
?>