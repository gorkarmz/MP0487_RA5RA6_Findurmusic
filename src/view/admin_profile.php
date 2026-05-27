<?php

require_once '../controller/ShowEventInformation.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <script src="../assets/jQuery/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/deleteProfile.js" defer></script>
    <script src="../assets/js/modal.js" defer></script>
    <script src="../assets/js/EventDetailsAJAX.js" defer></script>
    <script src="../assets/js/updateEventAJAX.js" defer></script>
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
                        <button onclick="window.location.href='update_profile.php'">
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
                        <p class="text1"> Usuarios Activos</p>
                        <p class="text1">Posts Totales</p>
                    </div>
                </div>
            </div>
            <div class="artistas">
                <h2>Admin manage tools:</h2>
                <div class="update_a">
                    <ul>
                        <li><button id="openCreateModal">1. CREATE EVENT</button></li>
                        <li><button id="openUpdateModal">2. UPDATE EVENT</button></li>
                        <li><button id="openDeleteModal">3. DELETE EVENT</button></li>
                        <br>
                        <?php
                        echo isset($_SESSION['success_message']) ? '<span class="success-message">' . $_SESSION['success_message'] . '</span>' : '';
                        unset($_SESSION['success_message']);
                        echo isset($_SESSION['error_message']) ? '<span class="error-message">' . $_SESSION['error_message'] . '</span>' : '';
                        unset($_SESSION['error_message']);
                        ?>
                    </ul>
                </div>
            </div>
            <br>
        </header>
        <footer>
            <p id="Muro">
                Admin Dashboard
                *Interacciones del Admin en el Dashboard*
            </p>
        </footer>
        <a href="index.php">
            <p id="volver">Volver a la página principal</p>
        </a>
    </div>

    <!-- MODAL PARA LA CREACION DE UN EVENTO: -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- &times es la X para cerrar el modal -->
            <span class="close">&times;</span>

            <form id="eventForm" action="../controller/XController.php" method="POST">

                <label for="eventName">Nombre del Concierto:</label>
                <input type="text" id="eventName" name="eventName" required>

                <label for="eventType">Tipo de evento:</label>
                <input type="text" id="eventType" name="eventType" required>

                <label for="eventLocation">Localizacion del evento:</label>
                <input type="text" id="eventLocation" name="eventLocation" required><br>

                <input type="submit" value="Crear Evento" name="createEvent" required>
            </form>
        </div>
    </div>

    <!-- MODAL PARA LA ACTUALIZACIÓN DE UN EVENTO: -->
    <div id="updateModal" class="updateModal">
        <div class="updateModal-content">
            <!-- &times es la X para cerrar el modal -->
            <span class="close2">&times;</span>

            <form id="updateForm" action="../controller/XController.php" method="POST">

                <label for="nombre_concierto">Conciertos a modificar:</label>

                <?php showEventNames(); ?>
                <br>
                <label for="newEventName">Modificar nombre del evento:</label>
                <input type="text" id="newEventName" name="newEventName" required>

                <label for="newEventType">Modificar tipo de evento:</label>
                <input type="text" id="newEventType" name="newEventType" required>

                <label for="newEventLocation">Modificar localización del evento:</label>
                <input type="text" id="newEventLocation" name="newEventLocation" required> <br>

                <input type="submit" value="Actualizar Evento" id="updateEventButton" name="updateEvent" required>
                <input type="button" value="Actualizar Evento AJAX" id="AjaxUpdateEventButton" name="updateEvent" required>
                <br>
                <span id="success-message-container"></span>
                <span id="error-message-container" ></span>
            </form>
        </div>
    </div>

    <!-- MODAL PARA LA ELIMINACIÓN DE UN EVENTO: -->
    <div id="deleteModal" class="deleteModal">
        <div class="deleteModal-content">
            <!-- &times es la X para cerrar el modal -->
            <span class="close3">&times;</span>

            <form id="deleteForm" action="../controller/XController.php" method="POST">

                <label for="deleteInput">Conciertos a eliminar:</label>

                <?php showEventNames(); ?>

                <input type="submit" value="Eliminar Evento" name="deleteEvent" required>
            </form>
        </div>
    </div>
</body>

</html>