<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Nueva lista de reproducción</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php'); ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="form">
        <h1>Crear nueva lista de reproducción</h1>
        <div class="alert alert-dismissible" id="alert">
            <span id="alert-message"></span>
            <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
        </div>
        <form id="new-playlist" novalidate autocomplete="off">
            <div class="form-group">
                <label for="">Nombre de la lista: </label>
                <br>
                <input name="name" type="text" placeholder="Escriba el nombre" class="form-control" required minlength="2">
                <div class="invalid-feedback">
                    Ingrese un nombre válido para la lista
                </div>
            </div>
            <?php 
                if(isset($_GET['movie']))
                {
                    $id = $_GET['movie'];
                    echo "<input type='hidden' value='$id' name='movie'>";
                }
            ?>
            <div class="form-group form-group-lg" align="center">
                <label for="">Breve descripción</label>
                <br>
                <textarea style="max-width: 50%" class="form-control" rows="5" id="descrption" name="description" maxlength="250" placeholder="Escriba una breve descripción" required></textarea>
                <!--input name="description" maxlength="250" type="text" minlength="0"
                placeholder="Escriba una descripcíon para su lista. Máximo 250 caracteres" 
                class="form-control input-lg" required-->
                <div class="invalid-feedback">
                    Ingrese una descripción
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning quote" title="Cambiar contraseña">Crear lista</button>
            </div>
        </form>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/playlist.js"></script>
</body>

</html>