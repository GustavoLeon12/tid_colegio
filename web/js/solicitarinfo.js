document.addEventListener("DOMContentLoaded", function() {
    // Muestra el modal solo cuando se hace clic en el enlace de términos y condiciones
    document.getElementById('link-terminos').onclick = function(event) {
        event.preventDefault();
        document.getElementById('modal-terminos').style.display = 'flex'; // Cambia 'block' a 'flex' para centrarlo
        document.body.style.overflow = 'hidden'; // Desactiva el scroll de la página
    };

  // Cerrar el modal de términos y condiciones al hacer clic en "Cancelar"
  document.getElementById('cancel-terminos').onclick = function() {
    document.getElementById('modal-terminos').style.display = 'none';
    document.body.style.overflow = 'auto';  // Restaura el scroll de la página
  }

  // Aceptar los términos y condiciones (cierra el modal y marca el checkbox)
  document.getElementById('accept-terminos').onclick = function() {
    document.getElementById('modal-terminos').style.display = 'none';
    document.getElementById('check-terminos').checked = true;  // Marca el checkbox
    document.body.style.overflow = 'auto';  // Restaura el scroll de la página
  }

  // Cerrar el modal si el usuario hace clic fuera de él
  window.onclick = function(event) {
    if (event.target == document.getElementById('modal-terminos')) {
      document.getElementById('modal-terminos').style.display = 'none';
      document.body.style.overflow = 'auto';  // Restaura el scroll de la página
    }
  }
});