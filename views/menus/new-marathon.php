<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Nuevo maratón</title>
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
        <h1>Crear nuevo maraton</h1>
        <p>Por favor, complete este formulario antes de comenzar a elegir películas para el maratón</p>
        <div class="alert alert-dismissible" id="alert">
            <span id="alert-message"></span>
            <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
        </div>
        <form id="new-marathon" novalidate autocomplete="off">
            <div class="form-group">
                <label for="">Nombre del maratón: </label>
                <br>
                <input name="name" type="text" placeholder="Escriba el nombre" class="form-control" required minlength="2">
                <div class="invalid-feedback">
                    Ingrese un nombre
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">Descripción del maratón</label>
                <br>
                <textarea name="description" style="max-width: 50%" class="form-control" rows="5" id="descrption" maxlength="250" placeholder="Escriba una breve descripción" required></textarea>
                <div class="invalid-feedback">
                    Ingrese una descripción
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">¿Qué tipo de películas tiene el maratón?</label>
                <br>
                <textarea name="movies" style="max-width: 50%" class="form-control" rows="3" id="descrption" maxlength="250" placeholder="Escriba su respuesta" required></textarea>
                <div class="invalid-feedback">
                    Ingrese su respuesta
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">¿A qué tipo de público va dirigido el maratón?</label>
                <br>
                <textarea name="public" style="max-width: 50%" class="form-control" rows="3" id="descrption" maxlength="250"  placeholder="Escriba su respuesta" required></textarea>
                <div class="invalid-feedback">
                    Ingrese su respuesta
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">¿Qué género de películas abunda en el maratón?</label>
                <br>
                <textarea name="genrse" style="max-width: 50%" class="form-control" rows="3" id="descrption" maxlength="250"  placeholder="Escriba su respuesta" required></textarea>
                <div class="invalid-feedback">
                    Ingrese su respuesta
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">¿Cuál es la intención del maratón?</label>
                <br>
                <textarea name="intention" style="max-width: 50%" class="form-control" rows="3" id="descrption" maxlength="250"  placeholder="Escriba su respuesta" required></textarea>
                <div class="invalid-feedback">
                    Ingrese su respuesta
                </div>
            </div>
            <div class="form-group form-group-lg" align="center">
                <label for="">¿Por qué el nombre del maratón?</label>
                <br>
                <textarea name="reason" style="max-width: 50%" class="form-control" rows="3" id="descrption" maxlength="250"  placeholder="Escriba su respuesta" required></textarea>
                <div class="invalid-feedback">
                    Ingrese su respuesta
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning quote" title="Cambiar contraseña">Continuar con la selección de películas</button>
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
    <script src="../../js/marathon.js"></script>
</body>

</html>