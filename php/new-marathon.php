<?php 
    include_once('Connection.php');
    session_start();

    $name = addslashes($_POST['name']);
    $description = addslashes($_POST['description']);
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $types = addslashes($_POST['movies']);
    $public = addslashes($_POST['public']);
    $genre  = addslashes($_POST['genre']);
    $intention  = addslashes($_POST['intention']);
    $reason = addslashes($_POST['reason']);
    $owner = $_SESSION['username'];

    $temp = new Connection();
    $conn = $temp->getConnection() or die('"connection"');

    $sql = "INSERT INTO maraton(
        nombre,descripcion,inicio,fin,tipo,publico,genero,intencion,razon,creador
    ) VALUES(
        '$name',
        '$description',
        '$begin',
        '$end',
        '$types',
        '$public',
        '$genre',
        '$intention',
        '$reason',
        '$owner'
    )";

    mysqli_query($conn,$sql) or die('"query"');

    echo json_encode($conn->insert_id);
?>