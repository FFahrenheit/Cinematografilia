<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Aceptar maratones</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/communication.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/profile.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Admin.php');
    $admin = new Admin();
    if (!$admin->isAdmin) {
        header("Location: error.php");
    }
    ?>
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
                <i class="fas fa-ticket-alt"></i> Revisar maratones
            </h2>
            <nav class="profile-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-received" role="tab" aria-controls="nav-received" aria-selected="true">Solicitudes</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-sent" role="tab" aria-controls="nav-sent" aria-selected="false">Lorem impsum</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-received" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php
                    echo $admin->getMarathons();
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-sent" role="tabpanel" aria-labelledby="nav-home-tab">
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

</body>

</html>