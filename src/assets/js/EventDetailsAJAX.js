// Captura la selección del usuario. 
$("select[name='eventName']").change(function() {
    var eventName = $(this).val();
    
    // Hacemos la solicitud ajax al servidor 'ShowEventInformation.php'.
    $.ajax({
        url: "../controller/ShowEventInformation.php",
        type: "POST",
        dataType: "json",
        // Ponemos en true getEventDetails y rellenamos la variable eventName del php.
        data: { getEventDetails: true, eventName: eventName },
        success: function(data) {
            // Rellenamos los valores de los input con los datos de la respuesta del php.
            $("#newEventName").val(data.Nombre);
            $("#newEventType").val(data.Tipo);
            $("#newEventLocation").val(data.Localizacion);
        },
        error: function() {
            alert("Error al obtener los detalles del evento.");
        }
    });
});