<?php

require_once 'Database.php';


$event = new AdminController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Boton de crear evento.
    if (isset($_POST["createEvent"])) {
        $event->create();
    }
    // Boton de actualizar evento.
    if (isset($_POST["updateEvent"])) {
        $event->update();
    }
    // Boton de borrar evento.
    if (isset($_POST["deleteEvent"])) {
        $event->delete();
    }
}
class AdminController
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create(): void
    {
        $eventName = $_POST["eventName"];
        $eventLocation = $_POST["eventLocation"];
        $eventType = $_POST["eventType"];

        // Manejo de errores de parte del servidor.
        if (empty($eventName) || empty($eventLocation) || empty($eventType)) {
            $_SESSION['error_message'] = "Todos los campos son obligatorios.";
            header('Location: ../view/admin_profile.php');
            exit();
        }

        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM EVENTO WHERE Nombre = :eventName");
        $stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Si el evento ya existe, informar al usuario y salir del método.
        if ($result['count'] > 0) {
            $_SESSION['error_message'] = "El evento '$eventName' ya existe en la base de datos, inténtelo de nuevo.";
            header('Location: ../view/admin_profile.php');
            exit();
        }

        $stmt = $this->conn->prepare("INSERT INTO EVENTO (Nombre, Localizacion, Tipo) VALUES (:eventName, :eventLocation, :eventType)");
        $stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $stmt->bindParam(':eventLocation', $eventLocation, PDO::PARAM_STR);
        $stmt->bindParam(':eventType', $eventType, PDO::PARAM_STR);
        try {
            // Ejecutar la consulta.
            $stmt->execute();
            // Mensaje para notificar al usuario.
            $_SESSION['success_message'] = "El evento '$eventName' se ha creado correctamente.";

        } catch (PDOException $e) {
            die("Error en la creación del evento: " . $e->getMessage());
        }
        echo '<script>window.location.href = "../view/admin_profile.php";</script>';
        exit();

    }

    public function update(): void
    {
        $oldEventName = $_POST['eventName'];
        $newEventName = $_POST["newEventName"];
        $newEventLocation = $_POST["newEventLocation"];
        $newEventType = $_POST["newEventType"];

        // Manejo de errores de parte del servidor.
        if (empty($oldEventName) || empty($newEventName) || empty($newEventLocation) || empty($newEventType)) {
            $_SESSION['error_message'] = "Todos los campos son obligatorios para actualizar el evento.";
            header('Location: ../view/admin_profile.php');
            exit();
        }

        // Verificar si el nuevo nombre del evento ya existe en la base de datos.
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM EVENTO WHERE nombre = :newEventName");
        $stmt->bindParam(':newEventName', $newEventName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el nuevo nombre del evento ya existe, informar al usuario.
        if ($result['count'] > 0) {
            $_SESSION['error_message'] = "El nuevo nombre del evento '$newEventName' ya existe. Por favor, elija un nombre diferente.";
            header('Location: ../view/admin_profile.php');
            exit();
        }
        
        // Actualización del evento.
        $stmt = $this->conn->prepare("UPDATE EVENTO 
        SET nombre = :newEventName, localizacion = :newEventLocation, tipo = :newEventType 
        WHERE nombre = :oldEventName");
        $stmt->bindParam(':oldEventName', $oldEventName, PDO::PARAM_STR);
        $stmt->bindParam(':newEventName', $newEventName, PDO::PARAM_STR);
        $stmt->bindParam(':newEventLocation', $newEventLocation, PDO::PARAM_STR);
        $stmt->bindParam(':newEventType', $newEventType, PDO::PARAM_STR);

        try {
            // Ejecutar la consulta.
            $stmt->execute();
            // Mensaje para notificar al usuario de la actualización.
            $_SESSION['success_message'] = "El evento '$oldEventName' se ha actualizado correctamente.";
        } catch (PDOException $e) {
            die("Error en la actualización del evento: " . $e->getMessage());
        }
        echo '<script>window.location.href = "../view/admin_profile.php";</script>';
        exit();
    }

    public function delete(): void
    {
        $eventName = $_POST['eventName'];
        // Manejo de errores de parte del servidor.
        if (empty($eventName)) {
            $_SESSION['error_message'] = "Todos los campos son obligatorios.";
            header('Location: ../view/admin_profile.php');
            exit();
        }
        try {
            $stmt = $this->conn->prepare("DELETE FROM Evento WHERE Nombre=:eventName");
            $stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['success_message'] = "El evento '$eventName' se ha borrado correctamente.";

        } catch (PDOException $e) {
            echo "Error al borrar el evento: " . $e->getMessage();
        }
        echo '<script>window.location.href = "../view/admin_profile.php";</script>';
        exit();
    }
}
