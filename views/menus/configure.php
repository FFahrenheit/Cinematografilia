<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Administrar cuenta</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <link href="../../css/styles.css" rel="stylesheet">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php'); ?>
</head>

<body>
    <?php getNavBar() ?>
    <?php
    if (!isset($_SESSION['username'])) {
        header("Location: error.php");
    } else {
        $username = $_SESSION['username'];
    }
    $connection = mysqli_connect("localhost", "root", "", "spoileralert") or die('"Error de conexión"');
    $query = "SELECT imagen FROM usuario WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $information = mysqli_fetch_assoc($result);
        $image = $information['imagen'];
    }
    ?>
    <div class="sa_configure">
        <h1>Administrar cuenta</h1>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Mi perfil</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Seguridad</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Preferencias y opciones</a>
            </div>

        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <h3>Imagen de perfil</h3>
                <div class="row container">
                    <div class="col-md-4">
                        <div class="sa_center_img">
                            <img class="sa_img" src=<?php echo '"' . $image . '"'; ?>>
                            <br>
                            <h6 onclick="deleteImage()">Eliminar imagen</h6>
                        </div>
                    </div>
                    <div class="col-md-8 sa_upload">
                        <form id="image-change" novalidate>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input style="width: 70%" type="file" accept="image/*" name="image" id="image" class="form-control" placeholder="Imagen" required>
                                <div class="invalid-feedback">
                                    Seleccione una imagen válida
                                </div>
                            </div>
                            <div id="alert" class="alert sa_alert"></div>
                            <p>Esta imagen será pública para toda la comunidad</p>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning" id="insert">
                                    Actualizar imagen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h3>Cambiar contraseña</h3>
                <form id="password-change" class="form-left" novalidate>
                    <div class="form-group">
                        <label for="">Contraseña actual: </label>
                        <br>
                        <input name="old_password" type="password" placeholder="Escriba su contraseña" class="form-control" required minlength="4">
                        <div class="invalid-feedback">
                            La contraseña debe tener mínimo 4 caracteres
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Nueva contraseña: </label>
                        <br>
                        <input name="password" type="password" placeholder="Escriba su contraseña" class="form-control" required minlength="4" id="pass" onkeyup="checkPassword()">
                        <div class="invalid-feedback">
                            La contraseña debe tener mínimo 4 caracteres
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Validar contraseña: </label>
                        <br>
                        <input name="password" type="password" placeholder="Escriba su contraseña" class="form-control" required onkeyup="checkPassword()" id="cPass">
                        <div class="invalid-feedback">
                            La contraseña debe tener mínimo 4 caracteres
                        </div>
                        <br>
                        <span id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning quote" title="Cambiar contraseña">"I've made changes for you, Shrek."</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                .
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
    <script src="../../js/register.js"></script>
    <script src="../../js/configure_profile.js"></script>

</body>

</html>