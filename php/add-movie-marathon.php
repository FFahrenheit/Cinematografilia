<?php 
    include_once('Connection.php');
    $movie = $_POST['movie'];
    $marathon = $_POST['marathon'];
    $APIKey = "b27f9641";
    
    $temp = new Connection();
    $conn = $temp->getConnection() or die ("connection");

    if($movie == "0")
    {
        goto getMovies;
    }
    $sql = "INSERT INTO maraton_peliculas(pelicula,maraton) VALUES ('$movie',$marathon)";

    mysqli_query($conn,$sql) or die("query");

    if(mysqli_affected_rows($conn)>0)
    {
        getMovies:
        $sql = "SELECT pelicula FROM maraton_peliculas WHERE maraton = $marathon ORDER BY orden ASC";
        $rs = mysqli_query($conn,$sql);
        $out="";
        while($rs && $data = mysqli_fetch_assoc($rs))
        {
            $mov = $data['pelicula'];
            $url = "http://www.omdbapi.com/?apikey=$APIKey&i=$mov";
            $content = file_get_contents($url);
            $movie = json_decode($content,true);
    
            if($movie['Response']=='True')
            {
                $out .= '<tr>';
                $arg = "'".$movie['imdbID']."'";
                $arg2 = "'".$movie['Title']."'";
        
                $hr = "<a style='color: white;' href = 'movie.php?id=".$movie['imdbID']."'>";
                $poster = ($movie['Poster']=="N/A")? "../../img/poster.jpg" : $movie['Poster'];
                $out .= "<td>$hr<img src='".$poster."'></a></td>";
                $out .= "<td>$hr".$movie['Title']." (".$movie['Year'].") </a></td>";
                
                $out .= '<td><a title="Borrar del maratón" onclick="removeMovie('.$arg.','.$arg2.',this);"><i class="fas fa-trash"></i></a></td>';
        
                $out .= '</tr>';
            }
        }
        echo $out;
    }
    else 
    {
        echo "repeat";
    }
?>