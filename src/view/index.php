<?php


require_once '../controller/ShowEventInformation.php';

?>

<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/slick//slick/slick.css">
    <link rel="stylesheet" href="../assets/slick/slick/slick-theme.css">
    <script src="../assets/jQuery/jquery-3.7.1.min.js"></script>
    <script src="../assets/slick/slick/slick.js"></script>
    <script src="../assets/js/jQuery.js" defer></script>
    <script src="../assets/js/paginationAJAX.js" defer></script>


</head>

<body>
    <div id="cookies">
        <p>Para poder navegar correctamente en nuestra página web, debes aceptar el uso de cookies.</p>
        <button id="accept-cookies" name="accept-cookies">Aceptar</button>
        <button id="reject-cookies" name="reject-cookies">Denegar</button>
    </div>

</body>


<header>

    <nav>
        <div class="contenidor-relative">

            <img id="logo" src="../assets/img/findurmusic.png" alt="logo" width="210" height="220">
            <input type="text" placeholder="  Busca información...">
            <?php

            if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                // Mostrar contenido para usuarios autenticados
                echo '
                        <div class="registers">
                            <div>
                                <button class="btnRegisters">
                                    <img class="imgRegisters" src="../assets/img/login.png" alt="logout" width="20" height="20">
                                    <p>Logout</p>
                                </button>
                            </div>
                        </div>
                    ';
            } else {
                // Mostrar contenido para usuarios no autenticados
                echo '
                        <div class="registers">
                            <div>
                                <button class="btnRegisters">
                                    <img class="imgRegisters" src="../assets/img/login.png" alt="login" width="20" height="20">
                                    <p>Login</p>
                                </button>
                            </div>
                            <div>
                                <button class="btnRegisters">
                                    <img class="imgRegisters" src="../assets/img/register.png" alt="register" width="20" height="20">
                                    <p>Register</p>
                                </button>
                            </div>
                            <div>
                                <button class="btnRegisters">
                                    <img class="imgRegisters" src="../assets/img/register.png" alt="register" width="20" height="20">
                                    <p>Register Admin</p>
                                </button>
                            </div>
                        </div>
                    ';
            }
            ?>
            <?php

            // Verificar si el usuario está logeado
            if (isset($_SESSION['logged']) && $_SESSION['logged']) {
                // Verificar si el usuario es un administrador
                if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                    // Mostrar contenido específico para administradores
                    // Por ejemplo, un enlace al panel de administrador
                    echo '<div class="perfil">
            <button class="btnRegisters" onclick="window.location.href=\'admin_profile.php\';">
            <img class="imgPerfil" src="../assets/img/perfil.png" alt="login" width="20" height="20">
            <p>Perfil Admin</p>
            </button>
    </div>

    <div class="registers">
        <div>
            <button class="btnRegisters" onclick="window.location.href=\'logout.php\';">
                <img class="imgRegisters" src="../assets/img/login.png" alt="logout" width="20" height="20">
                <p>Logout</p>
            </button>
        </div>
    </div>
                    ';
                } else {
                    // Mostrar contenido específico para usuarios normales
                    // Por ejemplo, un enlace al perfil del usuario
                    echo '<div class="perfil">
                    <button class="btnRegisters" onclick="window.location.href=\'profile.php\';">
                    <img class="imgRegisters" src="../assets/img/perfil.png" alt="profile" width="20" height="20">
                    <p>Perfil</p>
                </button>
            </div>

            <div class="registers">
                <div>
                    <button class="btnRegisters" onclick="window.location.href=\'logout.php\';">
                        <img class="imgRegisters" src="../assets/img/login.png" alt="logout" width="20" height="20">
                        <p>Logout</p>
                    </button>
                </div>
            </div>';
                }
            } else {
                // Mostrar contenido para usuarios no autenticados
                // Por ejemplo, un enlace para iniciar sesión
                echo '<div class="registers">
    <div>
        <button class="btnRegisters" onclick="window.location.href=\'login.php\';">
            <img class="imgRegisters" src="../assets/img/login.png" alt="login" width="20" height="20">
            <p>Login</p>
        </button>
    </div>
    <div>
        <button class="btnRegisters" onclick="window.location.href=\'register.php\';">
            <img class="imgRegisters" src="../assets/img/register.png" alt="register" width="20" height="20">
            <p>Register</p>
        </button>
    </div>

    <div>
        <button class="btnRegisters" onclick="window.location.href=\'admin_register.php\';">
            <img class="imgRegisters" src="../assets/img/register.png" alt="register" width="20" height="20">
            <p>Register Admin</p>
        </button>
    </div>
</div>';
            }
            ?>
            <div class="links">
                <button>TWITTER
                    <img src="../assets/img/twitter.png" width="20" height="20" alt="twitterImg">
                </button>
                <button>FACEBOOK
                    <img src="../assets/img/facebook.png" width="20" height="20" alt="facebookImg">
                </button>
                <button>INSTAGRAM
                    <img src="../assets/img/instagram.png" width="20" height="20" alt="instagramImg">
                </button>
            </div>

        </div>

    </nav>

</header>
<nav>
    <ul class="contenedor">
        <li class="elemento"><a href="#"><strong>Índex</strong></a></li>
        <li class="dropdown"><a href="#"><strong>Géneros</strong></a>
            <ul>
                <li class="dropdowncontent1"><a href="#"><strong>Pop</strong></a></li>
                <li class="dropdowncontent2"><a href="#"><strong>Rock</strong></a>
                </li>
            </ul>
        </li>
        <li class="elemento"><a href="#"><strong>TOP Artistas</strong></a></li>
        <li class="elemento"><a href="#"><strong>TOP Bandas</strong></a></li>
        <li class="elemento"><a href="#"><strong>TOP Canciones</strong></a></li>
        <li class="elemento"><a href="#"><strong>Música</strong></a></li>

    </ul>
</nav>



<h1 id="descubre"> ¡Consulta información sobre conciertos específicos!</h1>


<div class="flex-container eventSlider">

    <?php

    if (isset($_SESSION['logged']) && $_SESSION['logged']) {
        echo '
        <div class="c1">
        <a href="esdeveniment.php">
         <h1>Concierto 1</h1>


         <a href="esdeveniment.php">
         <img src="../assets/img/festival1.jpeg" width="550" height="350" alt="concierto1img">
        </a>
        </a>
        </div>
        ';
    } else {
        echo '
        <div class="c1">

        <h1>Concierto 1</h1>
        
        
         <img src="../assets/img/festival1.jpeg" width="550" height="350" alt="concierto1img">
        
        </div>';
    }

    ?>


    <div class="c2">
        <h1>Concierto 2</h1>
        <img src="../assets/img/festival2.jpeg" width="550" height="350" alt="concierto2img">
    </div>

    <div class="c3">
        <h1>Concierto 3</h1>
        <img src="../assets/img/festival3.jpeg" width="550" height="350" alt="concierto3img">
    </div>

    <div class="c3">
        <h1>Concierto 4</h1>
        <img src="../ASSETS/IMG/festival4.jpeg" width="550" height="350" alt="concierto4img">
    </div>

</div>


<h1 id="descubre"> ¡Eventos disponibles en nuestra página!</h1>


<div class="flex-container eventSlider">

    <?php showEventsInfo(); ?>

</div>

<h1 id="descubre"> PAGINACIÓN CON AJAX</h1>

<ul id="events-list"></ul>

</div>

<div id="button-container">
    <button id="prev-btn">Anteriores 5 eventos</button>
    <button id="next-btn">Siguientes 5 eventos</button>
</div>

<h1 id="descubre"> ¡Disfruta de tus artistas favoritos!</h1>

<div class="flex-container eventSlider">

    <div class="c1">

        <h3>Talentoso músico emergiendo en<br> la escena con su sonido innovador</h3>

        <img src="../ASSETS/IMG/artista1.jpg" width="550" height="350" alt="Imagen artista 1">
    </div>

    <div class="c2">
        <h3>Un artista independiente está captando<br> la atención con su música original</h3>

        <img src="../ASSETS/IMG/artista2.jpg" width="550" height="350" alt="Imagen artista 2">
    </div>

    <div class="c3">
        <h3>Joven cantautor está ganando <br>seguidores con su estilo distintivo.</h3>

        <img src="../ASSETS/IMG/artista3.jpg" width="550" height="350" alt="Imagen artista 3">
    </div>

    <div class="c4">
        <h3>Prometedor talento está destacando en <br>el mundo de la música con su voz única</h3>

        <img src="../ASSETS/IMG/artista4.jpg" width="550" height="350" alt="Imagen artista 4">
    </div>

    <div class="c5">
        <h3>Cantante emergente dejando huella con<br> su creatividad y pasión por la música</h3>

        <img src="../ASSETS/IMG/artista5.jpg" width="550" height="350" alt="Imagen artista 5">
    </div>


</div>
</div>

<footer id="footer">

    <div class="alinear1">
        <h1>Derechos de autor</h1>
        <img src="../assets/img/copyright.png" width="130" height="50" alt="copyrightImg">

    </div>
    <div class="alinear2">

        <div class="alinearTextos">
            <h1>FindUrMusic</h1>
            <h2>Tu web musical de confianza</h2>
            <button id="aboutUsBtn">About Us</button>
        </div>

    </div>

    <div class="alinear3">
        <p>Aviso legal.
            <br>
            Política de privacidad.
            <br>
            Diseñadores web: Matias y Dylan.
            <br>
            Curso: 1r DAM Stucom 2023-2024.
            <br>

        </p>
    </div>

</footer>

<div id="popupContainer" style="display: none;">
    <div id="popupContent">
        <div class="popupHeader">
            <button id="returnBtn">Return</button>
            <h2 id="orange" class="aboutUs">ABOUT US</h2>
        </div>
        <p class="aboutUs">Find your music is designed to give music lovers the opportunity to find their star in the
            musical world.</p>
        <p class="aboutUs">Email: findurmusic@example.com&nbsp;&nbsp;||&nbsp;&nbsp;Contact number: +932514543</p>
    </div>
</div>

</body>

</html>