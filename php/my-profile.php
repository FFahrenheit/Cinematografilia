<?php 
    session_start();
    if(isset($_SESSION['username']))
    {
        $user = $_SESSION['username'];
        header("Location: ../views/menus/profile.php?user=$user");
    }
    else 
    {
        header("Location: ../views/menus/login.php");
    }
?>