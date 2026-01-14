document.addEventListener('DOMContentLoaded', function () {
  const cronogramaBtns = document.querySelectorAll('#btnCronogramaMatricula');
  const cronogramaModal = document.getElementById('cronogramaModal');
  const cronogramaCloseBtn = document.getElementById('cronogramaClose');

  cronogramaBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      cronogramaModal.classList.add('cronograma-modal--active');
      document.body.style.overflow = 'hidden';
    });
  });

  if (cronogramaCloseBtn) {
    cronogramaCloseBtn.addEventListener('click', function () {
      cronogramaModal.classList.remove('cronograma-modal--active');
      document.body.style.overflow = 'auto';
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && cronogramaModal.classList.contains('cronograma-modal--active')) {
      cronogramaModal.classList.remove('cronograma-modal--active');
      document.body.style.overflow = 'auto';
    }
  });
});
