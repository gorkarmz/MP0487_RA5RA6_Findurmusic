<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['logged'])) {
    // El usuario está logueado, limpiar variables de sesión
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión actual

    // Redirigir a la página de inicio de sesión
    header("Location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/logout.css">
</head>

<body>
    <div class="container">
        <h1>LOGOUT</h1>

        <p>
            Te has deslogueado correctamente de la sesión.
        </p>

        <br>
        <a href="index.php">
            <p id="volver">Volver a la página principal</p>
        </a>
    </div>
</body>

</html>
