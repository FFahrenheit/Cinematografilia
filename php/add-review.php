<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $user = $_SESSION['username'];
    $movie = $_POST['movie'];
    $review  = addslashes($_POST['review']);
    $calification = $_POST['calification'];
    $recomended = isset($_POST['recomended'])? "1" : "0";
    $spoilers = isset($_POST['spoilers'])? "1" : "0";

    $sql = "INSERT INTO calificacion(pelicula, usuario, valor) VALUES ('$movie','$user',$calification)
    ON DUPLICATE KEY UPDATE valor = $calification";

    mysqli_query($conn,$sql) or die('"1"');

    $sql = "INSERT INTO review(pelicula, usuario, texto,spoilers,recomendada) 
    VALUES ('$movie','$user','$review',$spoilers, $recomended)";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
