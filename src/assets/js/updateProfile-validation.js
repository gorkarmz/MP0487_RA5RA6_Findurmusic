// Validación del updateProfile form.
$("#updateProfileForm").validate({
    // Nos permite que los inputs no se muevan al hacer popup las validaciones. 
    errorElement: "div",
    errorPlacement: function(error, element) {
        // Insertar el mensaje de error debajo del input correspondiente.
        error.insertAfter(element);

        // Estilizar el mensaje de error.
        error.css({
            "font-size": "14px",
            "color": "red"
        });
    },
    rules: {
        new_username: {
            required: true,
            email: true,
            minlength: 12,
            maxlength: 50
        },
        new_password: {
            required: true,
            minlength: 10,
            maxlength: 25
        },           
    },
    messages: {
         // Mensajes personalizados para cada input.
        new_username: {
            required: "Por favor, introduce tu nuevo correo electrónico.",
            minlength: "El correo electrónico debe tener al menos 12 carácteres.",
            maxlength: "El correo electrónico no puede tener más de 50 carácteres.",
            email: "Por favor, introduzca un formato de correo electrónico válido."
        },
        new_password: {
            required: "Por favor, introduce tu nueva contraseña.",
            minlength: "La contraseña debe tener al menos 10 carácteres.",
            maxlength: "La contraseña no puede tener más de 20 carácteres."
        },

    },
    // Nos permite que los inputs no se muevan al hacer popup las validaciones.
    errorClass: "Error"
});