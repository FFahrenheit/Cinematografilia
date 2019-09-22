<html lang="es">

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Playlist.php'); ?>
    <?php
    $user = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
    if (isset($_GET['id'])) {
        $playlist = new Playlist($_GET['id'], $user);
    } else { }
    if (!$playlist->isReal) {
        header("Location: error.php");
    }
    ?>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title><?php echo $playlist->name . " de " . $playlist->owner . " en SpoilerAlert!" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/profile.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/mosaic.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
</head>

<body>
    <?php getNavBar() ?>
    <div class="playlist">
        <div class="row container-fluid">
            <div class="col-md-4">
                <a href="#">
                    <div><?php echo $playlist->getPoster(); ?>
                </a>
                <br>
                <div id="title-form">
                    <h2><?php echo $playlist->getName(); ?></h2>
                </div>
                <?php echo $playlist->doILikeIt(); ?>
                <h3><?php echo $playlist->getOwner(); ?></h3>
                <h4><i title="Me gustas" class="fas fa-thumbs-up"></i> <?php echo $playlist->likes; ?> &nbsp;<i title="Peliculas en la lista" class="fas fa-film"></i> <?php echo $playlist->movieCount; ?></h4>
                <h6><i class="far fa-calendar-minus"></i><?php echo $playlist->date; ?></h6>
                <div id="description-form">
                    <h5><?php echo $playlist->description ?> </h5>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="alert alert-dismissible" id="alert">
                <span id="alert-message"></span>
                <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
            </div>
            <h3 style="text-align: left;">Peliculas en la lista</h3>
            <?php echo $playlist->getMovies(); ?>
        </div>
    </div>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/profile.js"></script>
    <script src="../../js/playlist.js"></script>
</body>

</html>