<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>¡Bienvenido a SpoilerAlert!</title>
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
    <div class="sa_baner">
        <a href="weekly-question.php">
            <h4 class="bg-warning text-dark weekly">¡Responde nuestra pregunta de la semana haciendo click aquí!</h4>
        </a>
    </div>
    <main role="main" class="bg-sa-full">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="../../img/index1.jpg" alt="Explorar películas">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1 class="shadowed">Explore películas</h1>
                <p class="shadowed">Busque sus películas favoritas, vea las reseñas, califíquelas, agréguelas a favoritos. Tenemos todas las películas en IMDB</p>
                <p><a class="btn btn-lg btn-warning" href="search.php" role="button">Busque películas hoy</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="../../img/index2.png" alt="Record de películas">
            <div class="container">
              <div class="carousel-caption">
                <h1 class="shadowed">Mantén el récord de tus películas.</h1>
                <p class="shadowed">Guarda las películas que ves, clasifícalas y ordénalas</p>
                <p><a class="btn btn-lg btn-warning" href="../../php/my-profile.php" role="button">Vea su perfil o únase</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="../../img/index3.jpg" alt="Tops">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1 class="shadowed">Analice los tops.</h1>
                <p class="shadowed">Visite los tops globales y semanales de las películas reseñadas en el sitio</p>
                <p><a class="btn btn-lg btn-warning" href="global-tops.php" role="button">Vea los tops</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
      </div>
      <div class="container marketing">
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" src="../../img/contact1.jpg" alt="Agrega amigos" width="140" height="140" style="object-fit:cover">
            <h2 class="text-warning">Agrega amigos</h2>
            <p class="text-light">Agrega contactos para ver sus gustos fílmicos, ver su recuento cinematográfico y estar más unido con la comunidad</p>
            <p><a class="btn btn-warning" href="friend-requests.php" role="button">Agrega amigos &raquo;</a></p>
          </div>
          <div class="col-lg-4">
            <img class="rounded-circle" src="../../img/contact2.jpg" alt="Chats" width="140" height="140" style="object-fit:cover">
            <h2 class="text-warning">Habla con ellos</h2>
            <p class="text-light">No solo veas sus gustos ¡Habla con ellos de lo que quieran!</p>
            <p><a class="btn btn-warning" href="chats.php" role="button">Chatea &raquo;</a></p>
          </div>
          <div class="col-lg-4">
            <img class="rounded-circle" src="../../img/contact3.jpg" alt="Recomendaciones" width="140" height="140" style="object-fit:cover">
            <h2 class="text-warning">Recomiéndales peliculas</h2>
            <p class="text-light">Si crees que una película le gustará a tu amigo, ¡No dudes en enviársela!</p>
            <p><a class="btn btn-warning" href="recomendations.php" role="button">Empieza a recomendar &raquo;</a></p>
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading text-warning">Únete a maratones <span class="txt-wrng-mtd">Y haga los suyos.</span></h2>
            <p class="lead text-light">Acércate a la comunidad uniéndote a maratones para ver películas en un lapso determinado. Sea anfitrión de su propio maratón</p>
            <a href="marathons.php" class="btn btn-warning text-dark">Ve los maratones</a><br>
        </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto sa-ftr" src="../../img/feature1.jpg" alt="Maratones">
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading text-warning">Visita las playlists. <span class="txt-wrng-mtd">Y haz las tuyas.</span></h2>
            <p class="lead text-light">Junta tus películas de acuerdo a tus gustos, compártelas con la comunidad y conoce nuevas películas basado en tus intereses.</p>
            <a href="playlists.php" class="btn btn-warning text-dark">Ve las playlists</a><br>
        </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto sa-ftr" src="../../img/feature2.jpeg"  alt="Playlists">
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading text-warning">Conoce la comunidad. <span class="txt-wrng-mtd">Y deja que la comunidad te conozca a ti.</span></h2>
            <p class="lead text-light">Únete a la comunidad, al fin y al cabo a todos nos mueve lo mismo: El gusto por las películas.</p>
            <a href="register.php" class="btn btn-warning text-dark">Únete hoy mismo</a><br>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto sa-ftr" src="../../img/feature3.jpg" alt="Comunidad">
          </div>
        </div>
        <hr class="featurette-divider">
      </div>
    </main>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
</body>

</html>