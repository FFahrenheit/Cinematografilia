<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <title>Contesta la pregunta de la semana</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href="../../css/communication.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Question.php');
    $quest = new Question(); ?>
</head>

<body>
    <?php getNavBar() ?>
    <div class="alert alert-dismissible" id="alert">
        <span id="alert-message"></span>
        <a href="#" class="close" onclick="$('#alert').hide();">&times;</a>
    </div>
    <div class="questions">
        <a href="weekly-question-result.php">
            <h4 class="bg-warning text-dark weekly">¡Ve los resultados de la semana pasada!</h4>
        </a>
        <br>
        <h3><?php echo $quest->getQuestion(); ?></h3>
        <?php echo $quest->getSearchBar(); ?>
        <div id="answers">
        </div>
    </div>
    <div id="footer">
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js" crossorigin="anonymous"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/question.js"></script>
</body>

</html>