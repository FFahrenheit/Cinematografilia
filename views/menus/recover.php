<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Recuperar contraseña</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    getLogged();
    ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="form">
        <h2>Escribe tu nombre de usuario para restablecer la contraseña</h2>
        <div class="alert alert-dismissible" id="alert">
            <span id="alert-message"></span>
            <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
        </div>
        <form id="recover" novalidate>
            <div class="form-group">
                <label for="">Nombre de usuario: </label>
                <br>
                <input type="text" name="username" placeholder="Escriba su nombre de usuario" class="form-control" required>
                <div class="invalid-feedback">
                    Ingresa el nombre de usuario
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning quote" title="Iniciar sesión">Recuperar contraseña</button>
            </div>
        </form>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/login.js"></script>
</body>

</html>