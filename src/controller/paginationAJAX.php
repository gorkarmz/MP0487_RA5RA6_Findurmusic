<?php

require_once 'Database.php';

// Nos conectamos a la base de datos para recoger la informacion de los eventos.

function getEvents($limit, $offset)
{
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT Nombre, Localizacion, Tipo FROM EVENTO LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviamos como respuesta la lecutra de los eventos.
    echo json_encode($events);
}

// Estas variables tienen valor gracias al AJAX y nos serviran para limitar los eventos por 5 desde la query.
if (isset($_POST['limit']) && isset($_POST['offset'])) {
    getEvents($_POST['limit'], $_POST['offset']);
}