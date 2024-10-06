function toggleBloque(bloqueId) {
    // Obtener el contenedor del bloque
    var bloque = document.getElementById('bloque-' + bloqueId);
    
    // Verificar si el bloque está visible u oculto y alternar su estado
    if (bloque.style.display === 'none' || bloque.style.display === '') {
        bloque.style.display = 'block'; // Mostrar el bloque
    } else {
        bloque.style.display = 'none'; // Ocultar el bloque
    }
}