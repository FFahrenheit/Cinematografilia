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
                <img src="<?php 
                echo $movie['Poster'] == "N/A" ? "../../img/poster.jpg": $movie['Poster']; ?>" 
                alt="<?php echo $title; ?>">
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
                                        <a class="dropdown-item bg-light" onclick="addToFavorite('<?php echo $id . $bool; ?>')"><i class="fas fa-star"></i>Favoritas</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item bg-light" onclick="addToLikes('<?php echo $id . $bool; ?>')"><i class="fas fa-thumbs-up"></i>Me gustan</a>
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
                        <div class="review">
                            <h3>Reseñas de la película
                                <select onclick="setMovie('<?php echo $id; ?>')"class="custom-select" id="review-list">
                                    <option selected>Seleccione orden</option>
                                    <option value="1">Con más me gusta</option>
                                    <option value="2">Más reciente</option>
                                </select>
                            </h3>
                            <div class="botonera">
                                <button class="btn btn-warning" onclick="seeReviewForm()">Escriba una reseña</button>
                                <span>&nbsp;ó&nbsp;</span>
                                <button class="btn btn-warning" onclick="seeCalificationForm()">Califique la película</button>
                            </div>
                            <div class="row bootstrap snippets reviews">
                                <div class="comment-wrapper">
                                    <div class="panel panel-info">
                                        <div class="panel-body">
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div id="reviews rounded">
                                                <ul class="media-list" id="review-section">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="ficha">
                            <?php echo $m->getLikes($_GET['id']); ?>
                            <?php echo $m->getFavorites($_GET['id']); ?>
                            <?php echo $m->getWatched($_GET['id']); ?>
                            <?php echo $m->getWatchlist($_GET['id']); ?>
                            <?php echo $m->getMyRating($_GET['id']); ?>
                            <?php echo $m->getRatings($_GET['id']); ?>
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
                    </form>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="seeForm()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog sa_modal bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title bg-dark" id="exampleModalLabel">Reseñar película</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <form id="form-review" novalidate>
                        <div class="form-group">
                            <label for="">Reseña</label><br>
                            <textarea style="max-width: 100%" class="form-control" rows="6" id="review" name="review" maxlength="2000" placeholder="Escriba su reseña" required></textarea>
                        </div>
                        <span>Calificación</span><br>
                        <i id="review1" title="Mala" class="fas fa-star" onclick="calification('review',1);"></i>
                        <i id="review2" title="Regular" class="far fa-star" onclick="calification('review',2);"></i>
                        <i id="review3" title="Buena" class="far fa-star" onclick="calification('review',3);"></i>
                        <i id="review4" title="Muy buena " class="far fa-star" onclick="calification('review',4);"></i>
                        <i id="review5" title="Perfecta" class="far fa-star" onclick="calification('review',5);"></i><br><br>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="spoilers" id="spoilers">
                            <label class="form-check-label" for="spoilers">La reseña contiene spoilers</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="recomended" name="recomended">
                            <label class="form-check-label" for="recomended">¿Recomienda la película?</label>
                        </div>
                    </form>
                </div>
                <input type="hidden" name="movie" value="<?php echo $id; ?>">
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="sendReview('<?php echo $id; ?>')">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="calificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog sa_modal bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title bg-dark" id="exampleModalLabel">Calificar película</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <div class="botonera">
                        <h2>Otorgue una calificación</h2>
                        <i id="calification1" title="Mala" class="fas fa-star" onclick="calification('calification',1);"></i>
                        <i id="calification2" title="Regular" class="far fa-star" onclick="calification('calification',2);"></i>
                        <i id="calification3" title="Buena" class="far fa-star" onclick="calification('calification',3);"></i>
                        <i id="calification4" title="Muy buena " class="far fa-star" onclick="calification('calification',4);"></i>
                        <i id="calification5" title="Perfecta" class="far fa-star" onclick="calification('calification',5);"></i>
                    </div>
                </div>
                <input type="hidden" name="movie" value="<?php echo $id; ?>">
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="sendCalification('<?php echo $id; ?>')">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog sa_modal bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title bg-dark" id="alertModalLabel">Calificar película</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <p id="alertModalText"></p>
                </div>
                <input type="hidden" name="movie" value="<?php echo $id; ?>">
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="confirm()">Confirmar</button>
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
    <script src="../../js/review.js"></script>
    <script src="../../js/main.js"></script>
    <script>
        $( document ).ready(()=> {
            console.log("Cargando reviews");
            loadReviews('<?php echo $id; ?>');
        });
    </script>
</body>

</html>