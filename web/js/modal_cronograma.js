document.addEventListener('DOMContentLoaded', function() {
  const cronogramaBtn = document.getElementById('btnCronogramaMatricula');
  const cronogramaModal = document.getElementById('cronogramaModal');
  const cronogramaCloseBtn = document.getElementById('cronogramaClose');

  // Abrir modal
  if (cronogramaBtn) {
    cronogramaBtn.addEventListener('click', function() {
      cronogramaModal.classList.add('cronograma-modal--active');
      document.body.style.overflow = 'hidden';
    });
  }

  // Cerrar modal con botón X
  if (cronogramaCloseBtn) {
    cronogramaCloseBtn.addEventListener('click', function() {
      cronogramaModal.classList.remove('cronograma-modal--active');
      document.body.style.overflow = 'auto';
    });
  }

  // Cerrar modal al hacer clic fuera del contenido
  /*if (cronogramaModal) {
    cronogramaModal.addEventListener('click', function(e) {
      if (e.target === cronogramaModal) {
        cronogramaModal.classList.remove('cronograma-modal--active');
        document.body.style.overflow = 'auto';
      }
    });
  }*/

  // Cerrar modal con tecla ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && cronogramaModal.classList.contains('cronograma-modal--active')) {
      cronogramaModal.classList.remove('cronograma-modal--active');
      document.body.style.overflow = 'auto';
    }
  });
});