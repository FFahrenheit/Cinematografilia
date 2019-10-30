<?php 
    $query = str_replace(" ","+",$_POST['search']);
    $APIKey = "b27f9641";

    $url = "http://www.omdbapi.com/?apikey=$APIKey&s=$query&type=movie";
    $content = file_get_contents($url);
    $response = json_decode($content,true);

    if($response['Response']=='True')
    {
        if($response['totalResults']>0)
        {
            $out = '<table class ="table table-hover sa_table"><tbody>';
            foreach($response['Search'] as $movie)
            {
                $out .= '<tr>';
                $arg = "'".$movie['imdbID']."'";
                $arg2 = "'".$movie['Title']."'";

                $hr = "<a style='color: white;' href = 'movie.php?id=".$movie['imdbID']."'>";
                $poster = ($movie['Poster']=="N/A")? "../../img/poster.jpg" : $movie['Poster'];
                $out .= "<td>$hr<img src='".$poster."'></a></td>";
                $out .= "<td>$hr".$movie['Title']." (".$movie['Year'].") </a></td>";
                
                $out .= '<td><a title="Seleccionar respuesta" onclick="setAnswer('.$arg.','.$arg2.',this);"><i class="far fa-square"></i></a></td>';

                $out .= '</tr>';
            }
            $out .= '</tbody></table>';
            echo $out;
        }
        else 
        {
            echo "<h4 class='text-danger'>No se han encontrado resultados de esta búsqueda</h4>";
        }
    }
    else 
    {
        echo "<h4 class='text-danger'>Error con la API: ".$response['Error']."</h4>";
    }
?>