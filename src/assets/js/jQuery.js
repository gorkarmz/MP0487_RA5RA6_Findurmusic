$(".eventSlider").slick({

    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToScroll: 1,
    arrows: false,
    responsive: [
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 2

            }
        },
        {

            breakpoint: 600,
            settings: {
                slidesToShow: 1,
            
            }
        }
    ]
})

//COOKIES

$(document).ready(function () {
    // Verificar si se ha aceptado o rechazado la política de cookies
    var cookiesAccepted = localStorage.getItem('cookiesAccepted');
    var cookiesRejected = localStorage.getItem('cookiesRejected');

    // Si se ha aceptado, ocultar el aviso y aplicar la clase correspondiente al body
    if (cookiesAccepted) {
        $('#cookies').hide();
        $('body').addClass('cookiesAccepted');
    }

    // Si se ha rechazado, ocultar el aviso y aplicar la clase correspondiente al body
    if (cookiesRejected) {
        $('#cookies').hide();
        $('body').addClass('cookiesRejected');

        // Ocultar el div de registers y hacer que se muestre un boton para acpetar las cookies.
        $('.registers').hide();
        $('.links').css('margin-bottom', '35px');
        $('.contenidor-relative').append('<button id="accept-cookies-notification" name="accept-cookies-notification">Aceptar cookies</button>');
    }

    // Manejar clic en el botón de aceptar cookies
    $('#accept-cookies').click(function () {
        // Guardar en localStorage que se han aceptado las cookies
        localStorage.setItem('cookiesAccepted', true);
        // Ocultar el aviso y aplicar la clase correspondiente al body
        $('#cookies').hide();
        $('body').addClass('cookiesAccepted');
    });

    // Manejar clic en el botón de rechazar cookies
    $('#reject-cookies').click(function () {
        // Guardar en localStorage que se han rechazado las cookies
        localStorage.setItem('cookiesRejected', true);
        // Ocultar el aviso y aplicar la clase correspondiente al body
        $('#cookies').hide();
        $('body').addClass('cookiesRejected');

        // Ocultar el div de registers y hacer que se muestre un boton para aceptar las cookies.
        $('.registers').hide();
        $('.links').css('margin-bottom', '35px');
        $('.contenidor-relative').append('<button id="accept-cookies-notification" name="accept-cookies-notification">Aceptar cookies</button>');
    });
    $(document).on('click', '#accept-cookies-notification', function () {

        // Hacer unset de las cookies previas rechazadas por el usuario.
        localStorage.removeItem('cookiesRejected');
        // Guardar en localStorage que se han aceptado las cookies
        localStorage.setItem('cookiesAccepted', true);
        // Mostrar los elementos dentro del div .registers
        $('.registers').show();
        // Posicionar el div de links correctamente.
        $('.links').css('margin-top', '69px');
        // Ocultar el botón "Aceptar cookies".
        $(this).hide();
    });
});


// About us logic

var aboutUsBtn = document.getElementById('aboutUsBtn');

// Obtener referencia al footer.
var footer = document.getElementById('footer');
var originalFooterContent = footer.innerHTML;
// Obtener referencia al contenido del popup "About Us".
var popupContent = document.getElementById('popupContent');

// Agregar un event listener para abrir el popup cuando se haga clic en el botón "About Us".
aboutUsBtn.addEventListener('click', function () {
    // Reemplazar el contenido del footer con el contenido del popup "About Us".
    footer.innerHTML = popupContent.innerHTML;

   
});

var aboutUsBtn = document.getElementById('returnBtn');

returnBtn.addEventListener('click', function () {
    footer.innerHTML = originalFooterContent.inner;

})