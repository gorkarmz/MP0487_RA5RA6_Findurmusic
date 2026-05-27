<?php
require_once 'Database.php';

function validateEmail() {

    $username = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_EMAIL) : '';

    if (empty($username) || !filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("message" => "Complete los campos correctamente."));
        return;
    }


    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM USUARIO WHERE Correo_electronico = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $response = array("message" => "Correo en uso, pruebe con otro.");
    } else {
        $response = array("message" => "Correo válido");
    }
    
    echo json_encode($response);
}

validateEmail();

