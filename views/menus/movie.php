<html lang="es">

<head>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Movie.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Profile.php');
    $url = "http://www.omdbapi.com/?apikey=$APIKey&plot=full&i=" . $_GET['id'];
    $id = $_GET['id'];
    $content = file_get_contents($url);
    $movie = json_decode($content, true);
    if ($movie['Response'] == 'False') {
        header("Location: error.php");
    }
    $title = $movie['Title'] . " (" . $movie['Year'] . ")";
    ?>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/profile.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
</head>

<body>
    <?php getNavBar() ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="sa_movie">
        <div class="row container">
            <div class="col-md-4">
                <img src="<?php echo $movie['Poster']; ?>" alt="<?php echo $title; ?>">
            </div>
            <div class="col-md-8">
                <h1> <?php
                        $m = new Movie();
                        echo $m->getIcons($_GET['id']);
                        $bool = $m->getWatch();
                        echo $title ?></h1>
                <div class="alert alert-dismissible" id="alert">
                    <span id="alert-message"></span>
                    <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
                </div>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ficha</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reseñas</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Estadísticas</a>
                        <?php if (isset($_SESSION['username'])) {
                            $profile = new Profile($_SESSION['username']); ?>
                            <div class="dropdown sa_add_to">
                                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Agregar a...
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li>
                                        <a class="dropdown-item bg-light" onclick="addToFavorite('<?php echo $id.$bool; ?>')"><i class="fas fa-star"></i>Favoritas</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item bg-light" onclick="addToLikes('<?php echo $id.$bool; ?>')"><i class="fas fa-thumbs-up"></i>Me gustan</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item bg-light" onclick="addToWatchlist('<?php echo $id; ?>')"><i class="far fa-clock"></i>Por ver</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item bg-light" onclick="addWatched('<?php echo $id; ?>')"><i class="far fa-eye"></i>Vistas</a>
                                    </li>
                                    <li class="dropdown-submenu dropdown-item bg-light sa_sub dropdown-toggle">
                                        <i class="fas fa-list"></i> Lista
                                        <ul class="dropdown-menu">
                                            <?php echo $profile->getPlaylist($id); ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="ficha">
                            <i class="far fa-calendar-alt"></i>Fecha de lanzamiento: <span class="text-light"><?php echo $movie['Released'] ?></span><br>
                            <i class="fas fa-exclamation-triangle"></i>Clasificación: <span class="text-light"><?php echo $movie['Rated'] ?></span><br>
                            <i class="far fa-clock"></i>Duración: <span class="text-light"><?php echo $movie['Runtime'] ?></span><br>
                            <i class="fas fa-couch"></i>Género(s): <span class="text-light"><?php echo $movie['Genre'] ?></span><br>
                            <i class="fas fa-video"></i>Director: <span class="text-light"><?php echo $movie['Director'] ?></span><br>
                            <i class="fas fa-pen"></i>Escritor: <span class="text-light"><?php echo $movie['Writer'] ?></span><br>
                            <i class="fas fa-users"></i>Cast: <span class="text-light"><?php echo $movie['Actors'] ?></span><br>
                            <i class="fas fa-book"></i>Trama: <span class="text-light"><?php echo $movie['Plot'] ?></span><br>
                            <i class="fas fa-flag-usa"></i>País(es): <span class="text-light"><?php echo $movie['Country'] ?></span><br>
                            <i class="fas fa-globe-europe"></i>Idioma(s): <span class="text-light"><?php echo $movie['Language'] ?></span><br>
                            <i class="fas fa-star"></i>Productora: <span class="text-light"><?php echo $movie['Production'] ?></span><br>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        ...
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="ficha">
                            <?php echo $m->getLikes($_GET['id']); ?>
                            <?php echo $m->getFavorites($_GET['id']); ?>
                            <?php echo $m->getWatched($_GET['id']); ?>
                            <?php echo $m->getWatchlist($_GET['id']); ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="watchedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog sa_modal bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title bg-dark" id="exampleModalLabel">Marcar película como vista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <form id="form-watched" novalidate>
                        <h6>Complete los datos para agregar a la lista</h6>
                        <div class="form-group">
                            <label for="">Fecha en que se vió: </label>
                            <br>
                            <input id="date-watch" type="date" name="fecha" class="form-control" required>
                            <div class="invalid-feedback">
                                Ingrese una fecha
                            </div>
                        </div>
                        <!--div class="form-check">
                            <input class="form-check-input" name="liked" type="checkbox" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                La película me gustó.
                            </label>
                        </div-->
                    </form>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="seeForm()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/movie.js"></script>
    <script src="../../js/main.js"></script>
</body>

</html>