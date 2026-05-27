$(document).ready(function(){
    // Ocultar el div #deleteProfile al cargar la página
    $("#deleteProfile").hide();
    
    $('#deleteButton').click(function(){
        // Mostrar el div #deleteProfile cuando se hace clic en el botón
        $("#deleteProfile").show();
        $("#overlay").show();
    });
    
    // Manejar clic en el botón de denegar la eliminación del perfil
    $('#reject-delete').click(function(){
        // Ocultar el div #deleteProfile cuando se hace clic en el botón "Denegar"
        $("#deleteProfile").hide();
        $("#overlay").hide();
    });
});