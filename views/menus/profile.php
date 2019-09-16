<html lang="es">

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Profile.php'); ?>
    <?php
    $username = $_GET['user'];
    $profile = new Profile($username);
    if (!$profile->isReal()) {
        header("Location: error.php");
    }
    ?>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title><?php echo "Perfil de ".$username . " en SpoilerAlert!" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/profile.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
</head>

<body>
    <?php getNavBar() ?>
    <div class="profile">
        <div class="profile-cover">
            <img src="../../img/cover.jpg">
        </div>
        <div class="profile-head">
            <img src=<?php echo '"' . $profile->getImage() . '"'; ?>>
            <h2>
                <?php
                echo $username;
                if ($username == $_SESSION['username']) {
                    echo '<a href="configure.php" title="Configurar">                <i class="fas fa-cog"></i>
                    </a>';
                }
                ?></h2>
            <p>Miembro desde <?php echo $profile->getDate(); ?></p>
            <nav class="profile-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Insignias</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Favoritas</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Vistas</a>
                    <a class="nav-item nav-link" id="nav-watchlist-tab" data-toggle="tab" href="#nav-watchlist" role="tab" aria-controls="nav-watchlist" aria-selected="false">Por ver</a>
                    <a class="nav-item nav-link" id="nav-lists-tab" data-toggle="tab" href="#nav-lists" role="tab" aria-controls="nav-lists" aria-selected="false">Listas</a>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    .
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    ..
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    ...
                </div>
                <div class="tab-pane fade" id="nav-watchlist" role="tabpanel" aria-labelledby="nav-watchlist">
                    ....
                </div>
                <div class="tab-pane fade" id="nav-lists" role="tabpanel" aria-labelledby="nav-lists">
                    .....
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