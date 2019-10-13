<?php
    ob_start();
    require_once('main.php');
    $movie = $_POST['movie'];
    $user = $_POST['user'];
    $username = $_SESSION['username'];

    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $sql = "SELECT vistas.pelicula FROM vistas, watchlist, favoritas, likes 
    WHERE
    (vistas.pelicula  = '$movie' AND vistas.usuario = '$user') OR 
    (watchlist.pelicula = '$movie' AND vistas.usuario = '$user')OR 
    (favoritas.pelicula = '$movie' AND vistas.usuario = '$user') OR
    (likes.pelicula = '$movie' AND vistas.usuario = '$user');";
    ob_clean();

    $rs = mysqli_query($conn,$sql) or die('"1"');
    if($rs)
    {
        if($rs->num_rows==0)
        {
            $sql = "INSERT INTO recomendacion(pelicula,emisor,receptor) VALUES ('$movie','$username','$user')";
            mysqli_query($conn,$sql) or die('"3"');

            $url = "http://www.omdbapi.com/?apikey=$APIKey&i=" . $movie;
            $content = file_get_contents($url);
            $body = json_decode($content, true);
            if($body['Response']=='True')
            {
                $msg = "<div class='recomend'>¡Hola! Te recomiendo ".$body['Title']." de ".$body['Director'].". Visita su ficha haciendo 
                click <a href='movie.php?id=$movie'>aquí</a>. O velo desde tus recomendaciones 
                <a href='recomendations.php'>aquí</a>.</div>";
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
    }
    else 
    {
        echo json_encode("1");
    }

?>