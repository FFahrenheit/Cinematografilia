<html lang="es">

<head>
    <link rel="shortcut icon" href="../../img/icono.png" />
    <?php $friend = $_GET['user']; ?>
    <title>Chat con <?php echo $friend; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../../css/index.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Overpass' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <link href="../../css/chat.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/257fce2446.js"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/main.php');
          include($_SERVER['DOCUMENT_ROOT'] . '/SpoilerAlert/php/Profile.php'); ?>
</head>

<body>
   <?php
    $myfr = new Profile($friend);
    $myfr->isChat();
   ?> 
    <div class="jumbotron m-0 p-0 bg-transparent">
        <div class="row m-0 p-0 position-relative">
            <div class="col-12 p-0 m-0 position-absolute" style="right: 0px;">
                <div class="card border-0 rounded" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.10), 0 6px 10px 0 rgba(0, 0, 0, 0.01); overflow: hidden; height: 100vh;">
                    <div style="background: black;border-radius:0;">
                        <?php getNavBar() ?>
                    </div>
                    <div class="card-header p-1 border border-top-0 border-left-0 border-right-0 blacked" style="color: rgba(246,197,25,1.0);">
                        <div class="sa_nav">
                            <a href="chats.php" title="Regresar a chats" class="chat-s">
                                <img class="rounded float-left chat-s" style="width: 50px; height: 50px;" src="https://png.pngtree.com/svg/20170222/white_back_1152661.png" />
                            </a>
                        </div>
                        <img class="rounded float-left" style="width: 50px; height: 50px;" src="<?php echo $myfr->getImage();?>" />
                        <h4 class="float-left" style="margin: 0px; margin-left: 10px;">
                            <?php echo $friend ?></br><small> <?php echo "Usuario desde ".$myfr->getDate(); ?> </small>
                        </h4>
                        <div class="dropdown show">
                            <a id="dropdownMenuLink" data-toggle="dropdown" class="btn btn-sm float-right text-secondary" role="button">
                                <h5><i class="fa fa-ellipsis-h" title="Ayarlar!" aria-hidden="true"></i>&nbsp;</h5>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right border p-0" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fa fa-user m-1" aria-hidden="true"></i> Visitar perfil </a>
                                <hr class="my-1">
                                <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fas fa-user-lock"></i> Bloquear usuario  </a>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-sohbet border-0 m-0 p-0" style="height: 100vh;">
                        <div id="sohbet" class="card border-0 m-0 p-0 position-relative bg-transparent" style="overflow-y: auto; height: 100vh;">
                            <!-- <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                <a class="float-right"> Hey there! What's up? </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                <a class="float-left sohbet2"> Checking out iOS7 you know.. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:23 pm">
                                <a class="float-right"> Check out this bubble! </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:26 pm">
                                <a class="float-left sohbet2"> It's pretty cool! </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:28 pm">
                                <a class="float-right"> Yeah it's pure CSS & HTML </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:33 pm">
                                <a class="float-left sohbet2"> Wow that's impressive. But what's even more impressive is that this bubble is really high. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                <a class="float-right"> Hey there! What's up? </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                <a class="float-left sohbet2"> Checking out iOS7 you know.. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:23 pm">
                                <a class="float-right"> Check out this bubble! </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:26 pm">
                                <a class="float-left sohbet2"> It's pretty cool! </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:28 pm">
                                <a class="float-right"> Yeah it's pure CSS & HTML </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:33 pm">
                                <a class="float-left sohbet2"> Wow that's impressive. But what's even more impressive is that this bubble is really high. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                <a class="float-right"> Hey there! What's up? </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                <a class="float-left sohbet2"> Checking out iOS7 you know.. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:23 pm">
                                <a class="float-right"> Check out this bubble! </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:26 pm">
                                <a class="float-left sohbet2"> It's pretty cool! </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:28 pm">
                                <a class="float-right"> Yeah it's pure CSS & HTML </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:33 pm">
                                <a class="float-left sohbet2"> Wow that's impressive. But what's even more impressive is that this bubble is really high. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                <a class="float-right"> Hey there! What's up? </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                <a class="float-left sohbet2"> Checking out iOS7 you know.. </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:23 pm">
                                <a class="float-right"> Check out this bubble! </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:26 pm">
                                <a class="float-left sohbet2"> It's pretty cool! </a>
                            </div>
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:28 pm">
                                <a class="float-right"> Yeah it's pure CSS & HTML </a>
                            </div>
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:33 pm">
                                <a class="float-left sohbet2"> Wow that's impressive. But what's even more impressive is that this bubble is really high. </a>
                            </div> -->
                        </div>
                    </div>
                    <div class="w-100 card-footer p-0 bg-dark border border-bottom-0 border-left-0 border-right-0">
                        <form class="m-0 p-0" action="" method="POST" autocomplete="off">
                            <div class="row m-0 p-0">
                                <div class="col-9 m-0 p-1">
                                    <input id="text" class="mw-100 border rounded form-control" type="text" name="text" title="Type a message..." placeholder="Type a message..." required>
                                </div>
                                <div class="col-3 m-0 p-1">
                                    <button class="btn btn-outline-secondary rounded border w-100" title="Gönder!" style="padding-right: 16px;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script>
    $(document).ready(() => {
        var objDiv = document.getElementById("sohbet");
        objDiv.scrollTop = objDiv.scrollHeight;
    })
</script>