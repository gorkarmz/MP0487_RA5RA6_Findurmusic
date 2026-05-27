
$(document).ready(function () {
    let isEmailValid = false;

    $("input[name='username']").blur(function () {
       
        let usernameAjax = $(this).val();
        $.ajax({
            url: "../controller/emailValidationAJAX.php",
            type: "POST",
            dataType: "json",
            data: { username: usernameAjax },
            success: function (data) {
                if (data.message === "Correo válido") {
                    $("#validationMessage").text(data.message).css("color", "green");
                    isEmailValid = true;
                } else {
                    $("#validationMessage").text(data.message).css("color", "red");
                    isEmailValid = false;
                }
            },
            error: function () {
                $("#validationMessage").text("Error al procesar la solicitud").css("color", "red");
                isEmailValid = false;
            }
        });
    });

    // No dejamos que el usuario interactue con el boton de registrar si el correo no es válido.
    $("#registerForm, #adminRegisterForm").submit(function (event) {
        // Si interactua con el boton de submit y el boolean esta en false, advierte al uusario y no le deja hacer submit.
        if (!isEmailValid) {
            event.preventDefault();
            $("#validationMessage").text("Correo no válido, no se puede registrar").css("color", "red");
        }
    });
});