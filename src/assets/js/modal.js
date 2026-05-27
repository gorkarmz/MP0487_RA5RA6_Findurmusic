 // Create modal popup.
$(document).ready(function createModal() {

    // Almacenamos en una variable, el div con la id de modal.
    var modal = document.getElementById("myModal");

    // Almacenamos en una variable, el boton con la id de openCreateModal.
    var btn = document.getElementById("openCreateModal");

    // Span que se encarga de cerrar el modal.
    var span = document.getElementsByClassName("close")[0];

    // Al hacer click en el boton con la id openCreateModal se abre el modal.
    btn.onclick = function () {
        modal.style.display = "block";
    }
    
    // Cerrar al modal darle a la X.
    span.onclick = function () {
        modal.style.display = "none";
    }

    

  
});

 // Update modal popup.
$(document).ready(function updateModal() {

    // Almacenamos en una variable, el div con la id de modal.
    var modal = document.getElementById("updateModal");

    // Almacenamos en una variable, el boton con la id de openUpdateModal.
    var btn = document.getElementById("openUpdateModal");

    // Span que se encarga de cerrar el modal.
    var span = document.getElementsByClassName("close2")[0];

    // Al hacer click en el boton con la id openUpdateModal se abre el modal.
    btn.onclick = function () {
        modal.style.display = "block";
    }
    
    // Cerrar al modal darle a la X.
    span.onclick = function () {
        modal.style.display = "none";
    }

  
});

// Delete modal popup.
$(document).ready(function updateModal() {

    // Almacenamos en una variable, el div con la id de modal.
    var modal = document.getElementById("deleteModal");

    // Almacenamos en una variable, el boton con la id de openDeleteModal.
    var btn = document.getElementById("openDeleteModal");

    // Span que se encarga de cerrar el modal.
    var span = document.getElementsByClassName("close3")[0];

    // Al hacer click en el boton con la id openDeleteModal se abre el modal.
    btn.onclick = function () {
        modal.style.display = "block";
    }
    
    // Cerrar al modal darle a la X.
    span.onclick = function () {
        modal.style.display = "none";
    }

  
});