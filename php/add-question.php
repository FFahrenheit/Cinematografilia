<?php 
    require_once('Connection.php');
    session_start();
    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');

    $question = $_POST['question'];

    $sql = "INSERT INTO preguntas(pregunta) VALUES ('$question')";
    
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