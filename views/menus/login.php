<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Iniciar sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php'); ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="form">
        <h2>¡Inicia sesión para mantener el seguimiento de tus películas!</h2>
        <img id="load" src="../../img/load.jpg" alt="Login for a cool animation"> 
        <form id="formulario" novalidate>
            <div class="form-group">
                <label for="">Nombre de usuario: </label>
                <br>
                <input type="text" name="username"
                    placeholder="Escriba su nombre de usuario" class="form-control"
                    required>
                <div class="invalid-feedback">
                    Ingresa el nombre de usuario
                </div>
            </div>
            <div class="form-group">
                <label for="">Contraseña: </label>
                <br>
                <input name="password" type="password" placeholder="Escriba su contraseña" class="form-control"
                    required>
                <div class="invalid-feedback">
                    La contraseña no puede estar vacía
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning quote" title="Iniciar sesión">"Let the games begin."</button>
            </div>
        </form>
        <p>¿No tienes una cuenta?
            <a href="register.php">
            Regístrate gratis</a>
        </p>
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
    <script src="../../js/login.js"></script>
</body>

</html>