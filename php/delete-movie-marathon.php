<?php 
    require_once('Connection.php');
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $movie = $_POST['movie'];
    $marathon = $_POST['marathon'];

    $sql = "DELETE FROM maraton_peliculas WHERE maraton = $marathon AND pelicula = '$movie'";
    // echo json_encode($sql);die();
    $result = mysqli_query($conn,$sql) or die("1");
    if($result && mysqli_affected_rows($conn)>0)
    {
        echo json_encode("2");
    }
    else
    {
        echo json_encode("1");
    }
?>