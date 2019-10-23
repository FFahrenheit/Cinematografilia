<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $movie = $_POST['movie'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO respuestas(usuario,pregunta,pelicula) VALUES 
    ('$user',(SELECT clave FROM preguntas WHERE estado = 'activa' LIMIT 1),'$movie')";

    mysqli_query($conn,$sql) or die('"1"');

    echo json_encode("2");
?> 
