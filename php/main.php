<?php 
    session_start();
    include 'Notification.php';
    include 'Connection.php';
    $APIKey = "b27f9641";
    if(isset($_SESSION['temporal']) && $_SESSION['temporal']=='lorem' 
    && $_SERVER['REQUEST_URI'] != '/SpoilerAlert/views/menus/new-password.php')
    {
        header("Location: new-password.php");
    }
    //echo $_SESSION['username'];

    function getLogged()
    {
        if(isset($_SESSION['username']))
            {
                header("Location: index.php");
            }
    }
    function getNavBar()
    {
        $nav = '<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color" id="navbar">
            <div class="sa_nav">
                <a class="navbar-brand" href="index.php">
                    <img  id="sa_nav" src="../../img/logo.png" alt="¡Bienvenido a SA!">
                    <span>SpoilerAlert!</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <ul class="navbar-nav mr-auto">';
        if(isset($_SESSION['username']) && $_SESSION['username']=="admin")
        {
            $nav .= '<li class="nav-item">
                        <a class="nav-link" href="reports.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-marathons.php">Revisar maratones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="review-questions.php">Preguntas semanales</a>
                    </li>
                </ul>';
        }
        else
        {
            $nav .= '<li class="nav-item">
                        <a class="nav-link" href="#">Listas
                            <!---span class="sr-only">(current)</span-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Maratones</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Tops
                        </a>
                        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            <a class="dropdown-item bg-light" href="#">Semanales</a>
                            <a class="dropdown-item bg-light" href="#">Globales</a>
                        </div>
                    </li>
                </ul>';
        }
            $nav .= '<ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item">
                        <form class="form-inline" action="search.php" method="GET">
                            <div class="md-form my-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Busca películas"
                                    aria-label="Search" name="title">
                            </div>
                        </form>
                    </li>';
        if(isset($_SESSION['username']))
        {
            $notifications = new Notification($_SESSION['username']);
            $nav .= $notifications->getNav();
            $nav .= '<li class="nav-item dropdown">
            <a title="Nuevo" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-222" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-plus"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-222">
                <a class="dropdown-item bg-light" href="new-playlist.php">Lista de reproducción</a>
                <a class="dropdown-item bg-light" href="new-marathon.php">Maraton</a>
            </div>
            </li>  ';
            $nav .= '<li class="nav-item dropdown">
            <a title="Perfil" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item bg-white" href="../../php/my-profile.php"><span class="font-weight-bold">
                '.$_SESSION['username'].'</span><br>Perfil</br></a>
                <a class="dropdown-item bg-light" href="configure.php">Administrar cuenta</a>
                <a class="dropdown-item bg-light" href="#" onclick="logout()"><span class="font-weight-bold">Cerrar sesión</span></a>
            </div>
            </li>';
        }
        else 
        {
            $nav .= '<li class="nav-item sa_link">
            <a class="nav-link" href="login.php">Inicia sesión</a>&nbsp;&nbsp;
            </li> <li class="nav-item sa_link">
            <a class="nav-link" href="register.php">Regístrate</a>
            </li>' ;   
        }
        $nav .= '</ul>
        </div>
        </nav>';
        echo $nav;
        return $nav;
    }
?>