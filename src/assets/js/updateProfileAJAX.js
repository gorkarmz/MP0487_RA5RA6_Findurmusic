$(document).ready(function () {

    $("#updateAjax").click(function () {

        // Si la validación del formulario es válida, hacemos la solicitud AJAX.
        if ($("#updateProfileForm").valid()) {
            let newEmailAjax = $("input[name='new_username']").val();
            let newPasswordAjax = $("input[name='new_password']").val();
            $.ajax({
                url: "../controller/updateProfileAjax.php",
                type: "POST",
                dataType: "json",
                data: {
                    new_email: newEmailAjax,
                    new_password: newPasswordAjax
                },
                success: function (data) {
                    if (data.identifier === "update_success") {
                        $("#validationMessage").text(data.message).css("color", "green");
                        
                    } else {
                        $("#validationMessage").text(data.message).css("color", "red");
                    }
                },
                error: function () {
                    $("#validationMessage").text("Error en la la respuesta del servidor.").css("color", "red");

                }
            });
        }
    });
});
