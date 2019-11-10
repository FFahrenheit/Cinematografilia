<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Explorar playlists></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Playlists.php');
    $playlist = new Playlists();
    $key = (isset($_GET['q']) && $_GET['q']!="")? $_GET['q'] : "";
    ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="sa_search">
        <h3 class="text-warning">Explorar playlists</h3>
        <form id="formulario" novalidate method="GET">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Título o palabra clave</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Titulo o palabra clave</div>
                        </div>
                        <input required name="q" type="text" value="<?php echo $key?>"class="form-control" id="inlineFormInputGroup" placeholder="Palabras clave">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-warning mb-2">Buscar</button>
                </div>
            </div>
        </form>
        <?php  
            if(isset($_GET['q']) && $_GET['q']!="")
            {
                echo $playlist->getQueriedPlaylists($_GET['q']);
            }
            else 
            {
                echo $playlist->getRandomPlaylists();
            }
        ?>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
    <script>
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var form = document.getElementById('formulario');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>
</body>

</html>