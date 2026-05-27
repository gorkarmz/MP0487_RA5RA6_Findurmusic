<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <script src="../assets/jQuery/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/deleteProfile.js" defer></script>
</head>

<body>

    <?php
    $username = isset($_SESSION['showName']) ? $_SESSION['showName'] : 'User name';
    ?>
    <div class="overlay" id="overlay"></div>
    <div class="centrar">
        <img id="img_fondo" src="../ASSETS/IMG/findurmusic.png" alt="logo_header_user" width="320" height="300">
        <header>

            <div class="header_usuario">
                <div class="update_class">
                    <h1><?php echo $username; ?></h1>
                    <div class="update_a">
                        <button onclick="window.location.href='update_profile.php';">
                            <p>EDIT PROFILE</p>
                        </button>

                        <button id="deleteButton">
                            <p>DELETE PROFILE</p>
                        </button>
                    </div>

                </div>

                <div id="deleteProfile">
                    <p>¿Estás seguro de que quieres borrar tu cuenta? Esta acción no se puede deshacer.</p>

                    <form action="../controller/UserController.php" method="POST">
                        <button id="accept-delete" name="accept-delete">Aceptar</button>
                    </form>

                    <button id="reject-delete" name="reject-delete">Denegar</button>
                </div>


                <div class="texto_derecha">
                    <img class="texto_derecha" src="../ASSETS/IMG/login_usuario.png" alt="login_user" width="120px">
                    <div class="texto_usuario">
                        <p class="text1"> Seguidores</p>
                        <p class="text1">Seguidos</p>
                        <p class="text1">Num. publicaciones</p>
                    </div>
                </div>

            </div>

            <div class="artistas">
                <h2>Artista favorito</h2>
                <br>
                <br>
                <br>
                <br>


                <h2>Mis eventos(...)</h2>
                <br>
                <br>
            </div>
        </header>
        <footer>
            <p id="Muro">
                Muro público
                *Mis interacciones en el muro*
            </p>
        </footer>
        <a href="index.php">
            <p id="volver">Volver a la página principal</p>
        </a>
    </div>

</body>

</html>