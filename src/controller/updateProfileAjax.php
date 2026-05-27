<?php
require_once 'Database.php';

function updateCredentials()
{
    // Variables que tienen valor gracias a la petición AJAX.
    $old_username = isset($_SESSION['user']) ? ($_SESSION['user']) : '';
    $new_email = isset($_POST['new_email']) ? ($_POST['new_email']) : '';
    $new_password = isset($_POST['new_password']) ? ($_POST['new_password']) : '';

    $success = null;
    $messageSuccess = "Actualización hecha correctamente.";
    $messageError = "No se ha podido actualizar el correo.";
    $successIdentifier = "update_success";
    $errorIdentifier = "update_error";

    // Mostrar el nombre actualizado en el perfil.
    if (!empty($new_email)) {
        $_SESSION['showName'] = $_POST['new_email'];
    }

    // Hashear la contraseña.
    if (!empty($new_password)) {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    }
    // Conexión a la base de datos.
    $db = new Database();
    $conn = $db->getConnection();

       // Verificar si el correo ya existe en la base de datos.
       $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM USUARIO WHERE Correo_electronico = :new_email AND Correo_electronico != :old_username");
       $stmt->bindParam(':new_email', $new_email, PDO::PARAM_STR);
       $stmt->bindParam(':old_username', $old_username, PDO::PARAM_STR);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
   
       // Si el correo no está disponible, informamos al usuario.
       if ($result['count'] > 0) {
           $response = array(
            "message" => $messageError,
            "identifier" => "update_error"
        );
        echo json_encode($response);
        exit();
    }
    // Update en la base de datos con los nuevos datos.
    try {
        $stmt = $conn->prepare("UPDATE USUARIO SET Correo_electronico=:new_username, Contrasena=:new_password WHERE Correo_electronico=:old_username");
        $stmt->bindParam(':new_username', $new_email, PDO::PARAM_STR);
        $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
        $stmt->bindParam(':old_username', $old_username, PDO::PARAM_STR);
        $stmt->execute();
        $success = true;
        $_SESSION["user"] = $_POST['new_email'];
        $_SESSION["password"] = $_POST['new_password'];
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        $success = false;
    }
    // Si todo se ha hecho correctamente, mandamos esta respuesta al AJAX
    if ($success) {
        $response = array(
            "message" => $messageSuccess,
            "identifier" => $successIdentifier
        );
    } else {
        $response = array(
            "message" => $messageError,
            "identifier" => $errorIdentifier
        );
    }
    echo json_encode($response);

}
updateCredentials();