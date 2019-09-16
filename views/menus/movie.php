<html lang="es">

<head>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    $url = "http://www.omdbapi.com/?apikey=$APIKey&plot=full&i=" . $_GET['id'];
    $content = file_get_contents($url);
    $movie = json_decode($content, true);
    $title = $movie['Title'] . " (" . $movie['Year'] . ")";
    ?>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
</head>

<body>
    <?php getNavBar() ?>
    <div class="sa_movie">
        <div class="row container">
            <div class="col-md-4">
                <img src="<?php echo $movie['Poster']; ?>" alt="<?php echo $title; ?>">
            </div>
            <div class="col-md-8">
                <h1> <?php echo $title ?></h1>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ficha</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reseñas</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Estadísticas</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="ficha">
                            <i class="far fa-calendar-alt"></i>Fecha de lanzamiento: <span class="text-light"><?php echo $movie['Released']?></span><br>
                            <i class="fas fa-exclamation-triangle"></i>Clasificación: <span class="text-light"><?php echo $movie['Rated']?></span><br>
                            <i class="far fa-clock"></i>Duración: <span class="text-light"><?php echo $movie['Runtime']?></span><br>
                            <i class="fas fa-couch"></i>Género(s): <span class="text-light"><?php echo $movie['Genre']?></span><br>
                            <i class="fas fa-video"></i>Director: <span class="text-light"><?php echo $movie['Director']?></span><br>
                            <i class="fas fa-pen"></i>Escritor: <span class="text-light"><?php echo $movie['Writer']?></span><br>
                            <i class="fas fa-users"></i>Cast: <span class="text-light"><?php echo $movie['Actors']?></span><br>
                            <i class="fas fa-book"></i>Trama: <span class="text-light"><?php echo $movie['Plot']?></span><br>
                            <i class="fas fa-flag-usa"></i>País(es): <span class="text-light"><?php echo $movie['Country']?></span><br>
                            <i class="fas fa-globe-europe"></i>Idioma(s): <span class="text-light"><?php echo $movie['Language']?></span><br>
                            <i class="fas fa-star"></i>Productora: <span class="text-light"><?php echo $movie['Production']?></span><br>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
</body>

</html>