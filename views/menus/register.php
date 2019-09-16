<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Únete a la comunidad</title>
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
        <h2>¡Únete hoy a SpoilerAlert!</h2>
        <img id="load" src="../../img/load.jpg" alt="Login for a cool animation"> 
        <div id="alert" role="alert" class="alert sa_alert">
        </div>
        <form id="formulario" novalidate>
            <div class="form-group">
                <label for="">Nombre de usuario: </label>
                <br>
                <input type="text" name="username"
                    placeholder="Escriba su nombre de usuario" class="form-control"
                    required minlength="4">
                <div class="invalid-feedback">
                    El nombre de usuario debe tener mínimo 4 caracteres
                </div>
            </div>
            <div class="form-group">
                <label for="">Correo electrónico: </label>
                <br>
                <input type="text" name="email" id="email"
                    placeholder="Escriba su nombre de correo" class="form-control"
                    required onkeyup="checkEmail()">
                <div class="invalid-feedback">
                    Ingrese el correo
                </div>
                <br>
                <span id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="">Contraseña: </label>
                <br>
                <input name="password" type="password" placeholder="Escriba su contraseña" class="form-control"
                    required minlength="4" id="pass" onkeyup="checkPassword()">
                <div class="invalid-feedback">
                    La contraseña debe tener mínimo 4 caracteres
                </div>
            </div>
            <div class="form-group">
                <label for="">Validar contraseña: </label>
                <br>
                <input name="password" type="password" placeholder="Escriba su contraseña" class="form-control"
                    required onkeyup="checkPassword()" id ="cPass">
                <div class="invalid-feedback">
                    La contraseña debe tener mínimo 4 caracteres
                </div>
                <br>
                <span id="passwordError"></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning quote" title="Registrarse">"This is where the fun begins."</button>
            </div>
        </form>
        <p>¿Ya tienes una cuenta?
            <a href="login.php">
            Inicia sesión</a>
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
    <script src="../../js/register.js"></script>
</body>

</html>