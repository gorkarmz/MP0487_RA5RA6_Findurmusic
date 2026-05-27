$(document).ready(function () {

    $("#AjaxUpdateEventButton").click(function () {
        // Hacemos la solicitud ajax al servidor 'email_validator.php'.
        let oldEventNameAJAX = $("select[name='eventName']").val();
        let newEventNameAJAX = $("input[name='newEventName']").val();
        let newEventLocationAJAX = $("input[name='newEventLocation']").val();
        let newEventTypeAJAX = $("input[name='newEventType']").val();

        $.ajax({
            url: "../controller/updateEventAJAX.php",
            type: "POST",
            dataType: "json",
            data: {
                oldEventName: oldEventNameAJAX,
                newEventName: newEventNameAJAX,
                newEventLocation: newEventLocationAJAX,
                newEventType: newEventTypeAJAX
            },
            success: function (data) {  
                if (data.status === 'success') {
                    $('#error-message-container').text('');
                    $('#success-message-container').text(data.message).css('color', 'green');
                } else {
                    $('#success-message-container').text('');
                    $('#error-message-container').text(data.message).css('color', 'red');
                }
            },
            error: function () {
                console.log("Error al procesar la solicitud.");

            }
        });
    });
});
