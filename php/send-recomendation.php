<?php
    ob_start();
    require_once('main.php');
    $movie = $_POST['movie'];
    $user = $_POST['user'];
    $username = $_SESSION['username'];

    $c = new Connection();
    $conn = $c->getConnection() or die('"0"');
    $sql = "SELECT vistas.pelicula FROM vistas, watchlist, favoritas, likes,
    recomendacion_bloqueo 
    WHERE
    (vistas.pelicula  = '$movie' AND vistas.usuario = '$user') OR 
    (watchlist.pelicula = '$movie' AND watchlist.usuario = '$user')OR 
    (favoritas.pelicula = '$movie' AND favoritas.usuario = '$user') OR
    (likes.pelicula = '$movie' AND likes.usuario = '$user') OR 
    (recomendacion_bloqueo.pelicula = '$movie' AND recomendacion_bloqueo.usuario = '$user')";
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
    }
    else 
    {
        echo json_encode("1");
    }

?>