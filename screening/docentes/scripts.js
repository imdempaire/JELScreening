// Esperar que el DOM esté completamente cargado antes de ejecutar el script
document.addEventListener("DOMContentLoaded", function() {
    // Seleccionar todos los títulos de los bloques
    const titulosBloques = document.querySelectorAll(".bloque-titulo");

    // Agregar un evento de clic a cada título
    titulosBloques.forEach(function(titulo) {
        titulo.addEventListener("click", function() {
            const bloqueId = this.getAttribute("data-bloque");
            const contenidoBloque = document.getElementById('bloque-' + bloqueId);

            // Alternar la clase 'oculto' en el contenedor del contenido del bloque
            contenidoBloque.classList.toggle("oculto");
        });
    });
});