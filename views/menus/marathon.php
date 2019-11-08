<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Marathons.php');
    if (!isset($_GET['clave'])) {
        header("Location: error.php");
    }
    $marathon = new Marathons($_GET['clave']);
    if (!$marathon->isValid()) {
        header("Location: error.php");
    }
    ?>
    <title>Detalles del maratón <?php echo $marathon->name; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/communication.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
</head>

<body>
    <?php getNavBar() ?>
    <div class="alert alert-dismissible" style="text-align:center;" id="alert">
        <span id="alert-message"></span>
        <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
    </div>
    <div class="questions">
        <div class="container">
            <div style="text-align:center;">
                <h3><?php echo "Detalles del maratón"; ?></h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <?php echo $marathon->getMovieBar() ?>
                    </div>
                    <div id="buttons">
                        <?php echo $marathon->getButtons(); ?>
                    </div>
                </div>
                <div class="col-md-6" style="text-align:left;">
                    <div id="details">
                        <?php echo $marathon->getDetails(); ?>
                    </div>
                    <div id="progress">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog sa_modal bg-dark" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title bg-dark text-light" id="confirmationModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-dark">
                        <p id="confirmationModalBody" class="text-light"></p>
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="proceed()">Confirmar</button>
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
    <script src="../../js/alert.js"></script>
    <script src="../../js/marathons.js"></script>
    <script src="../../js/marathon.js"></script>
    <script>
        setKey(<?php echo $_GET['clave']; ?>);
    </script>
</body>

</html>