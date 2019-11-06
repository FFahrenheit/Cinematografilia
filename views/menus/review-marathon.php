<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Detalles del maratón</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/communication.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Admin.php');
    if (!isset($_GET['clave'])) {
        header("Location: error.php");
    }
    $admin = new Admin();
    if (!$admin->isAdmin) {
        header("Location: error.php");
    }
    ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="alert alert-dismissible" style="text-align:center;" id="alert">
        <span id="alert-message"></span>
        <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
    </div>
    <div class="questions">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Películas del maratón</h3>
                    <div>
                        <table id="coolTable" class="table table-hover sa_table">
                            <tbody id="currentMovies">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Detalles del maratón</h3>
                    <div style="text-align:left">
                        <?php echo $admin->getMarathonAnswers($_GET['clave']); ?>
                    </div>
                    <br>
                    <div>
                        <?php echo $admin->getMarathonButtons($_GET['clave']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog sa_modal bg-dark" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title bg-dark" id="confirmationModalLabel">Rechazar maratón</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-dark">
                        <p id="confirmationModalBody">Por favor, indique las razones por las que el maratón fue rechazado</p>
                        <form id="formulario" novalidate>
                            <div class="form-group">
                                <label for="">Razón: </label>
                                <br>
                                <textarea name="reason" style="max-width: 100%" class="form-control" rows="6" id="review" maxlength="500" placeholder="Escriba los motivos del rechazo" required></textarea>
                                <br>
                                <div class="invalid-feedback">
                                    Escriba sus motivos
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="rejectMarathon()">Confirmar</button>
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
    <script src="../../js/alert.js"></script>
    <script src="../../js/admin.js"></script>
    <script>
        $(() => {
            m = <?php echo $_GET['clave']; ?>;
            setMarathonKey(<?php echo $_GET['clave']; ?>);
            $.ajax({
                    url: '/spoileralert/php/get-movies-marathon.php',
                    type: 'POST',
                    datatype: 'html',
                    data: {
                        movie: '0',
                        marathon: m
                    }
                })
                .done((r) => {
                    $("#currentMovies").html(r);
                })
        });
    </script>
</body>

</html>