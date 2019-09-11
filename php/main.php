<?php 
    session_start();
    include 'Connection.php';
    $connection = new Connection();

    function getNavBar()
    {
        $nav = "";
        $nav = 
        '<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color" id="navbar">
            <div class="sa_nav">
                <a class="navbar-brand" href="index.php">
                    <img  id="sa_nav" src="../../img/logo.png" alt="¡Bienvenido a SA!">
                    <span>SpoilerAltert!</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Listas
                            <!---span class="sr-only">(current)</span-->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Peliculas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Stats
                        </a>
                        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            <a class="dropdown-item" href="#">Mejores Películas</a>
                            <a class="dropdown-item" href="#">Últimas reseñas</a>
                            <a class="dropdown-item" href="#">Más contenido jaaj</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item">
                        <form class="form-inline">
                            <div class="md-form my-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Busca películas"
                                    aria-label="Search">
                            </div>
                        </form>
                    </li>';
        if(isset($_SESSION['username']))
        {
            $nav .= '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" href="#">Perfil</a>
                <a class="dropdown-item" href="#">Administrar cuenta</a>
                <a class="dropdown-item" href="#">Mis listas</a>
            </div>
                </li>';
        }
        else 
        {
            $nav .= '<li class="nav-item sa_link">
            <a href="login.php">Inicia sesión</a>&nbsp;&nbsp;
            </li> <li class="nav-item sa_link">
            <a href="register.php">Regístrate</a>
            </li>' ;   
        }
        $nav .= '</ul>
        </div>
        </nav>';
        echo $nav;
        return $nav;
    }
?>