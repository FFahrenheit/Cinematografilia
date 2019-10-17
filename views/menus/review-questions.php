<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Preguntas semanales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/communication.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/profile.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Admin.php');
    $admin = new Admin();
    if (!$admin->isAdmin) {
        header("Location: error.php");
    } ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="form">
        <div class="alert alert-dismissible" id="alert">
            <span id="alert-message"></span>
            <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
        </div>
        <div class="friend-requests">
            <h2>
                <i class="fas fa-question"></i> Preguntas de la semana
            </h2>
            <nav class="profile-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-received" role="tab" aria-controls="nav-received" aria-selected="true">Cola</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-sent" role="tab" aria-controls="nav-sent" aria-selected="false">Agregar pregunta</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-received" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php
                    echo $admin->getQueue();
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-sent" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form id="new-question" novalidate autocomplete="off">
                        <div class="form-group">
                            <label for="">Escriba la pregunta </label>
                            <br>
                            <input name="question" type="text" placeholder="Formule la pregunta de la semana" class="form-control" required minlength="8">
                            <div class="invalid-feedback">
                                Ingrese una pregunta de forma válida
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning quote" title="Cambiar contraseña">Agregar pregunta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog sa_modal bg-dark" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title bg-dark" id="confirmationModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-dark">
                        <p id="confirmationModalBody"></p>
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="confirmation()">Confirmar</button>
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
    <script src="../../js/profile.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/communication.js"></script>
    <script src="../../js/movie.js"></script>
    <script src="../../js/admin.js"></script>

</body>

</html>