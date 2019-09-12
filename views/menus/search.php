<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>¡Bienvenido a SpoilerAltert!</title>
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
        $title = $_GET['title'];
        $page = isset($_GET['page'])? $_GET['page'] : 1 ;?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="sa_search">
        <h2>Resultados para la búsqueda de "<?php echo $title ?>" </h2>
        <span> </span>
        <?php 
            $arg = str_replace(" ","+",$_GET['title']);
            $url = "http://www.omdbapi.com/?apikey=$APIKey&s=$arg&type=movie&page=$page";
            $content = file_get_contents($url);
            $json = json_decode($content,true);
            $cards = new Movie();
            if($json['Response'] == "True")
            {
                echo '<span class="text-light">Se han encontrado '.$json['totalResults'].' resultados';
                foreach($json['Search'] as $movie)
                {
                    echo $cards->getCard($movie);
                }
                echo $cards->getNavigator($page, $json['totalResults'],$title);

            }
            else if($json['Response']=="False")
            {
                echo $json['Error'];
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
</body>

</html>