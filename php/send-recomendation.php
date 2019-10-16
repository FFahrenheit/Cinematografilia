<?php
    ob_start();
    require_once('main.php');
    $movie = $_POST['movie'];
    $user = $_POST['user'];
    $username = $_SESSION['username'];

    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    ob_clean();

    if($c->getCount($conn,"SELECT COUNT(*) FROM vistas WHERE usuario  = '$user' AND pelicula = '$movie'")==0 && 
    $c->getCount($conn,"SELECT COUNT(*) FROM watchlist WHERE usuario  = '$user' AND pelicula = '$movie'")==0 && 
    $c->getCount($conn,"SELECT COUNT(*) FROM likes WHERE usuario  = '$user' AND pelicula = '$movie'")==0 && 
    $c->getCount($conn,"SELECT COUNT(*) FROM favoritas WHERE usuario  = '$user' AND pelicula = '$movie'")==0 && 
    $c->getCount($conn,"SELECT COUNT(*) FROM recomendacion_bloqueo WHERE usuario  = '$user' AND pelicula = '$movie'")==0 )
    {
        $sql = "INSERT INTO recomendacion(pelicula,emisor,receptor) VALUES ('$movie','$username','$user')";
        mysqli_query($conn,$sql) or die('"3"');

        $url = "http://www.omdbapi.com/?apikey=$APIKey&i=" . $movie;
        $content = file_get_contents($url);
        $body = json_decode($content, true);
        if($body['Response']=='True')
        {
            $msg = "¡Hola! Te recomiendo ".$body['Title']." de ".$body['Director'].". Visita su ficha haciendo 
            click <span class='recomend' onclick='window.location.href=".'"movie.php?id='.$movie.'"'."'>aquí</span>. O velo desde tus recomendaciones 
            <span class='recomend' onclick='window.location.href=".'"recomendations.php"'."'>aquí</span>.";
            $msg = addslashes($msg);
                    
            $sql = "INSERT INTO chat(emisor,receptor,mensaje) VALUES 
            ('$username','$user','$msg')";
            ob_clean();
            mysqli_query($conn,$sql) or die('"5"');

            echo json_encode("6");

        }
        else 
        {
            echo json_encode("4");
        }
    }
    else 
    {
        echo json_encode("2");
    }
?>