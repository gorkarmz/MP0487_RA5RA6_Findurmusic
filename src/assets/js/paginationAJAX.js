$(document).ready(function() {
    let limit = 5;
    let offset = 0;

    // Hacemos una funcion que tenga como parametros las variabels recien declaradas.
    function loadEvents(limit, offset) {
        $.ajax({
            url: "../controller/paginationAJAX.php",
            type: "POST",
            dataType: "JSON",
            data: {
                // Rellenaoms las variabels tipo GET de nuestro PHP.
                limit: limit,
                offset: offset
            },
            success: function(data) {
                // La variable events tendra el valor de la repuesta PHP.
                let events = data;
                let eventsList = $('#events-list');
                eventsList.empty();

                // Si hay eventos que mostrar, leemos los primeros 5.
                if (events.length > 0) {
                    events.forEach((event, index) => {
                        eventsList.append(`
                            <li>
                                <span class="event-number">${offset + index + 1}</span>
                                <div class="event-details">
                                    <p>PATROCINADO POR FINDURMUSIC <span></span></p>
                                    <p>NOMBRE: <span>${event.Nombre}</span></p>
                                    <p>TIPO: <span>${event.Tipo}</span></p>
                                    <p>LOCALIZACIÓN: <span>${event.Localizacion}</span></p>
                                </div>
                            </li>
                        `);
                    });
                } else {
                    // Cuando no hayan más eventos creados, se lo notificaremos al usuario.
                    eventsList.append('<li style="color: red;">No hay más eventos creados.</li>');
                }
            },
            error: function() {
                $('#events-list').append('<li style="color: red;">Error al cargar los eventos.</li>');
            }
        });
    }

    loadEvents(limit, offset);

    // Cada vez que se pulsa este boton, hacemos la lecture de los 5 eventos previos.
    $('#prev-btn').click(function() {
        if (offset > 0) {
            offset -= limit;
            // Invocamos a la función de loadEvents habiendole restado 5 a offset.
            loadEvents(limit, offset);
        }
    });

     // Cada vez que se pulsa este boton, hacemos la lecture de los 5 siguientes eventos.
    $('#next-btn').click(function() {
        offset += limit;
        // Invocamos a la función de loadevents habiendole sumado 5 a offset.
        loadEvents(limit, offset);
    });
});
