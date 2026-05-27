<?php

require_once 'Database.php';


//Check if form is submitted
$user = new UserController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Check button
    if (isset($_POST["login"])) {
        $user->login();
    }
    if (isset($_POST["logout"])) {
        $user->logout();
    }
    if (isset($_POST["register"])) {
        $user->register();
    }
    if (isset($_POST["update"])) {
        $user->update();
    }
    if (isset($_POST["accept-delete"])) {
        $user->delete();
    }

}

class UserController
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    //update 
    public function update(): void
    {
        // Validación para que un usuario no pueda actualizar su cuenta si no esta logueado.
        if (empty($_SESSION["user"])) {
            $_SESSION['error'] = 'Has sido redirigido a la pantalla de Login ya que tu sesión no era válida.';
            echo '<script>window.location.href = "../view/login.php";</script>';
            exit();
        }
        $old_username = $_SESSION["user"];
        $new_email = $_POST["new_username"];
        $new_password = $_POST["new_password"];

        // Validar que los inputs no esten vacíos.
        if (empty($new_email) || empty($new_password)) {
            $_SESSION['error'] = 'El nuevo nombre de usuario y la nueva contraseña no deben estar vacíos.';
            echo '<script>window.location.href = "../view/update_profile.php";</script>';
            exit();
        }
        // Hashear la nueva contraseña siempre y cuándo el campo no este vacío.
        if (!empty($new_password)) {
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        }

        // Verificar si el correo ya existe en la base de datos.
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS count FROM USUARIO WHERE Correo_electronico = :new_username AND Correo_electronico != :old_username");
        $stmt->bindParam(':new_username', $new_email, PDO::PARAM_STR);
        $stmt->bindParam(':old_username', $old_username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el correo no está disponible, informamos al usuario.
        if ($result['count'] > 0) {
            $_SESSION['error'] = "El nuevo nombre de usuario '$new_email' no esta disponible, inténtelo otra vez.";
            echo '<script>window.location.href = "../view/update_profile.php";</script>';
            exit();
        }

        try {
            // Actualizar el usuario.
            $stmt = $this->conn->prepare("UPDATE USUARIO SET Correo_electronico=:new_username, Contrasena=:new_password WHERE Correo_electronico=:old_username");
            $stmt->bindParam(':new_username', $new_email, PDO::PARAM_STR);
            $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
            $stmt->bindParam(':old_username', $old_username, PDO::PARAM_STR);
            $stmt->execute();

            // Actualizar el nuevo nombre email.
            $_SESSION['user'] = $new_email;
            $_SESSION["password"] = $_POST["new_password"];
            // Actualizar el nuevo email para que se muestre en el perfil.
            $_SESSION['showName'] = $new_email;

            // Redirecciones dependiendo de si es admin o no.
            $redirect_url = $_SESSION["admin"] ? "../view/admin_profile.php" : "../view/profile.php";

            echo '<script>window.location.href = "' . $redirect_url . '";</script>';
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar el usuario: " . $e->getMessage();
        }
    }
    public function delete(): void
    {
        // Si no existe la variable de sesión use, es que no existe una cuenta para borrar.
        if (isset($_SESSION["user"])) {
            $mail = $_SESSION["user"];

        } else {
            $_SESSION['error'] = 'Has sido redirigido a la pantalla de Login ya que tu sesión no era válida.';
            echo '<script>window.location.href = "../view/login.php";</script>';
            exit();
        }

        try {
            $stmt = $this->conn->prepare("DELETE FROM Usuario WHERE Correo_electronico=:username");
            $stmt->bindParam(':username', $mail, PDO::PARAM_STR);
            $stmt->execute();
            $this->logout();

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        echo '<script>window.location.href = "../view/index.php";</script>';
    }

    // FUNCION PARA INICIAR SESIÓN.
    public function login(): void
    {
        // Si no se recibe una solicitud post de login, retorna.
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["login"])) {
            return;
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $_SESSION["showName"] = $username;
        $stmt = $this->conn->prepare("SELECT Correo_electronico, Contrasena, esAdmin FROM USUARIO WHERE Correo_electronico=:username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Obtenemos los resultados de la consulta y lo almacenamos en $user en un array associativo.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Usamos password_Verify para encontrar la contraseña en la BD.
        if (!$user || !password_verify($password, $user['Contrasena'])) {
            $_SESSION["logged"] = false;
            $_SESSION["error"] = "Usuario o contraseña incorrectos";
            echo '<script>window.location.href = "../view/login.php";</script>'; // Redirigir al formulario de inicio de sesión
            exit(); // Salir después de la redirección
        }
        // Si ha encontrado la contraseña en la BD de datos ejecutamos las siguientes lineas.
        $_SESSION["logged"] = true;
        $_SESSION["user"] = $username;
        // La variable de sesion sera true si el usuario es admin o false si no lo es.
        $_SESSION["admin"] = $user['esAdmin'] == 1;

        // Si es admin va a adminprofile.php y si es user va a profile.php 
        $redirect_url = $_SESSION["admin"] ? "../view/admin_profile.php" : "../view/profile.php";
        echo '<script>window.location.href = "' . $redirect_url . '";</script>';
        exit();
    }


    // FUNCION PARA HACER LOG OUT.
    public function logout(): void
    {

        //clean variables
        unset($_SESSION["logged"]);
        unset($_SESSION["user"]);
        //destroy session
        session_destroy();
        //redirect to index page
        echo '<script>window.location.href = "../view/index.php";</script>';
    }

    // FUNCION PARA REGISTRARSE.
    public function register(): void
    {
        // Limpiar cualquier mensaje de error anterior.
        unset($_SESSION["error"]);
        // Obtener datos del formulario
        $username = $_POST["username"];
        $password = $_POST["password"];

        $_SESSION["showName"] = $username;

        // Modificar la obtención del valor de isAdmin.
        $esAdmin = isset($_POST["esAdmin"]) && $_POST["esAdmin"] === "true";

        // Validar el formato de correo electrónico.
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "<span style='color: red;'>Invalid email format, try again please.</span>";
            // Redireccionar al formulario de registro.
            if ($esAdmin) {
                $_SESSION["admin"] = true; // Establecer una bandera de sesión para administrador.

                echo '<script>window.location.href = "../view/admin_register.php";</script>';
            } else {
                echo '<script>window.location.href = "../view/register.php";</script>';
            }
            exit();
        }

        // Hasheamos la contraseña.
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("INSERT INTO USUARIO (Correo_electronico, Contrasena, esAdmin) VALUES (:username, :password, :esAdmin)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':esAdmin', $esAdmin, PDO::PARAM_INT);
        // Ejecutar la consulta SQL
        if ($stmt->execute()) {
            // Registro exitoso, establecer variables de sesión y redirigir
            $_SESSION["logged"] = true;
            $_SESSION["user"] = $username;
            $_SESSION["password"] = $_POST["password"];
            if ($esAdmin) {
                $_SESSION["admin"] = true; // Establecer una bandera de sesión para administrador

                echo '<script>window.location.href = "../view/index.php";</script>';
            } else {
                echo '<script>window.location.href = "../view/index.php";</script>';
            }
            exit();
        } else {
            // Error en la consulta SQL, mostrar un mensaje de error
            $_SESSION["error"] = "Registration failed. Please try again later.";
            echo '<script>window.location.href = "../view/register.php";</script>';
            exit();
        }
    }


}

?>