<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Búsqueda de <?php echo $_GET['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Movie.php'); 
        $title = isset($_GET['title'])? $_GET['title'] : "";
        $page = isset($_GET['page'])? $_GET['page'] : 1 ;
        $add = (isset($_GET['year']) && $_GET['year']!="")? "&y=".$_GET['year'] : ""; 
        $add2 = (isset($_GET['year']) && $_GET['year']!="")? "&year=".$_GET['year'] : "" ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="sa_search">
        <h2>
        <?php 
            if($title=="")
            {
                echo "Busque su película de preferencia";
            }
            else
            {
                echo "Resultados para la búsqueda de $title.";
            }

        if(isset($_GET['director']) && $_GET['director']!="")
        {
            echo " del director \"".$_GET['director'].'"';
        }?> </h2>
        <span> </span>
        <?php 
            $cards = new Movie();
            if(isset($_GET['director']) && $_GET['director']!="")
            {
                if(isset($_GET['year']) && $_GET['year']!="")
                {
                    echo $cards->advancedSearch(
                        str_replace(" ","+",$_GET['title']),
                        $_GET['director'],
                        $_GET['year']);
                }
                else 
                {
                    echo $cards->advancedSearch(
                        str_replace(" ","+",$_GET['title']),
                        $_GET['director']);
                }
            }
            else if($title!="")
            {
                $arg = str_replace(" ","+",$_GET['title']);
                if(substr($arg, -1)=="+")
                {
                    $arg = substr($arg, 0, -1);
                }
                $url = "http://www.omdbapi.com/?apikey=$APIKey&s=$arg&type=movie&page=$page$add";
                $content = file_get_contents($url);
                $json = json_decode($content,true); 
                if($json['Response'] == "True")
                {
                    echo '<span class="text-light">Se han encontrado '.$json['totalResults'].' resultado(s).</span>
                    <br><p> Nueva búsqueda:</p>';
                    echo $cards->getSearcher($title);
                    foreach($json['Search'] as $movie)
                    {
                        echo $cards->getCard($movie);
                    }
                    echo $cards->getNavigator($page, $json['totalResults'],$title.$add2);

                }
                else if($json['Response']=="False")
                {
                    if($json['Error'] == "Too many results.")
                    {
                        echo '<p class="text-light">La búsqueda ha arrojado muchos resultados, por favor sea más específico o filtre su búsqueda por año</p>';
                        echo $cards->getSearcher($title);

                    }
                    else if($json['Error']=="Movie not found!")
                    {
                        echo '<span class="text-light">No se han encontrado resultados con la búsqueda, intente de nuevo.</span>';
                        echo $cards->getSearcher($title);
                    }
                    else 
                    {
                        echo '<span class="text-light"> Error de API: '.$json['Error']."</span>";
                        echo $cards->getSearcher("");
                    }
                }
                else 
                {
                    echo "Error desconocido...";
                }
            }
            else 
            {
                echo $cards->getSearcher("");
            }
        ?>
    </div>
    <div id="footer">
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"
        crossorigin="anonymous"></script>
    <script src ="../../js/main.js"></script>
    <script>
        (function() {
    'use strict';
  
    window.addEventListener('load', function() {
      var form = document.getElementById('formulario');
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    }, false);
  })();
        </script>
</body>

</html>