<!-- Modal Editar Evento -->
<?php
require_once __DIR__ . '/../../models/calendario_model.php';
$model = new CalendarioModel();
$docentes = $model->obtenerDocentes();
$grados = $model->obtenerGrados();
$cursos = $model->obtenerCursos();
$aulas = $model->obtenerAulas();
$years = $model->obtenerYears();
?>
<div class="modal fade" id="modalEditarEvento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Editar Evento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formEditarEvento" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">
          <div class="row">
            <!-- Columna Izquierda - Información Principal -->
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label fw-semibold">Título <span class="text-danger">*</span></label>
                <input type="text" name="titulo" id="edit_titulo" class="form-control" required placeholder="Ingrese el título del evento">
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3" placeholder="Descripción del evento"></textarea>
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-semibold">Ubicación</label>
                <input type="text" name="ubicacion" id="edit_ubicacion" class="form-control" placeholder="Lugar donde se realizará el evento">
              </div>
              
              <div class="row">
                <div class="col-12 mb-3">
                  <label class="form-label fw-semibold">Fechas del Evento</label>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label small">Fecha Inicio <span class="text-danger">*</span></label>
                  <input type="datetime-local" name="fecha_inicio" id="edit_fecha_inicio" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label small">Fecha Fin</label>
                  <input type="datetime-local" name="fecha_fin" id="edit_fecha_fin" class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Color del Evento</label>
                <div class="d-flex align-items-center">
                  <input type="color" name="color" id="edit_color" class="form-control form-control-color me-2" value="#2196F3" style="width: 60px; height: 38px;">
                  <span class="small text-muted">Color de visualización</span>
                </div>
              </div>
            </div>
            
            <!-- Columna Derecha - Configuraciones Adicionales -->
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label fw-semibold">Información Académica</label>
                <div class="row g-2">
                  <div class="col-12 mb-2">
                    <select name="usuario_id" id="edit_usuario_id" class="form-select">
                      <option value="">-- Seleccione Docente (Opcional) --</option>
                      <?php foreach ($docentes as $doc): ?>
                        <option value="<?= $doc['id_docente'] ?>"><?= htmlspecialchars($doc['nombre_completo']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="grado_id" id="edit_grado_id" class="form-select">
                      <option value="">-- Grado (Opcional) --</option>
                      <?php foreach ($grados as $grado): ?>
                        <option value="<?= $grado['idgrado'] ?>"><?= htmlspecialchars($grado['gradonombre']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="curso_id" id="edit_curso_id" class="form-select">
                      <option value="">-- Curso (Opcional) --</option>
                      <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['idcurso'] ?>"><?= htmlspecialchars($curso['nonbrecurso']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="aula_id" id="edit_aula_id" class="form-select">
                      <option value="">-- Aula (Opcional) --</option>
                      <?php foreach ($aulas as $aula): ?>
                        <option value="<?= $aula['idaula'] ?>"><?= htmlspecialchars($aula['nombreaula']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="year_id" id="edit_year_id" class="form-select" required>
                      <option value="">-- Año Escolar * --</option>
                      <?php foreach ($years as $year): ?>
                        <option value="<?= $year['id_year'] ?>"><?= htmlspecialchars($year['yearScolar']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-semibold">Configuración de Recurrencia</label>
                <div class="form-check form-switch mb-2">
                  <input type="checkbox" name="recurrente" id="edit_recurrente" value="1" class="form-check-input">
                  <label class="form-check-label" for="edit_recurrente">Evento Recurrente</label>
                </div>
                <div class="recurrencia-config" style="display: none;">
                  <label class="form-label small">Describe la frecuencia del evento</label>
                  <input type="text" id="edit_regla_texto" class="form-control mb-2" placeholder="Ej: todos los lunes, diario, quincenal">
                  <input type="hidden" name="regla_recurrencia" id="edit_regla_recurrencia">
                  <div class="form-text small">
                    Ejemplos válidos: <br>
                    <code>todos los lunes</code> - Cada lunes<br>
                    <code>diario</code> - Todos los días<br>
                    <code>quincenal</code> - Cada 15 días<br>
                    <code>todos los miércoles y viernes</code> - Miércoles y Viernes
                  </div>
                  <div id="edit-rrule-preview" class="alert alert-info mt-2" style="display: none; font-size: 0.75rem;">
                    <strong>RRULE generada:</strong> <span id="edit-rrule-text"></span>
                  </div>
                </div>
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-semibold">Estado <span class="text-danger">*</span></label>
                <select name="estado" id="edit_estado" class="form-select" required>
                  <option value="">-- Seleccione --</option>
                  <option value="ACTIVO">Activo</option>
                  <option value="INACTIVO">Inactivo</option>
                  <option value="CANCELADO">Cancelado</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnEliminarEvento" class="btn btn-danger me-auto">
            <i class="fas fa-trash me-1"></i>Eliminar Evento
          </button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>Cerrar
          </button>
          <button type="submit" class="btn btn-warning text-white">
            <i class="fas fa-sync-alt me-1"></i>Actualizar Evento
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
.modal-content {
  border: none;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.modal-header {
  border-radius: 12px 12px 0 0;
  padding: 1rem 1.2rem;
}

.modal-body {
  padding: 1.2rem;
  max-height: calc(100vh - 200px);
  overflow-y: auto;
}

.modal-footer {
  border-top: 1px solid #dee2e6;
  padding: 0.8rem 1.2rem;
}

.form-label {
  color: #495057;
  margin-bottom: 0.4rem;
  font-size: 0.9rem;
}

.form-control, .form-select {
  border-radius: 6px;
  border: 1px solid #ced4da;
  transition: all 0.2s ease;
  font-size: 0.9rem;
  padding: 0.5rem 0.75rem;
}

.form-control:focus, .form-select:focus {
  border-color: #ffc107;
  box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.form-check-input:checked {
  background-color: #ffc107;
  border-color: #ffc107;
}

.form-switch .form-check-input {
  width: 2.5em;
  margin-right: 0.5rem;
}

.recurrencia-config {
  background: #f8f9fa;
  padding: 0.8rem;
  border-radius: 6px;
  border-left: 4px solid #ffc107;
  margin-top: 0.5rem;
}

.form-text {
  font-size: 0.8rem;
}

.form-text code {
  background: #e9ecef;
  padding: 2px 6px;
  border-radius: 3px;
  font-size: 0.75em;
}

.btn {
  border-radius: 6px;
  padding: 0.4rem 1rem;
  font-weight: 500;
  font-size: 0.9rem;
}

.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
  color: #212529;
}

.btn-warning:hover {
  background-color: #e0a800;
  border-color: #d39e00;
  color: #212529;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn-danger:hover {
  background-color: #c82333;
  border-color: #bd2130;
}

.mb-3 {
  margin-bottom: 0.8rem !important;
}

.mb-2 {
  margin-bottom: 0.5rem !important;
}

@media (max-width: 768px) {
  .modal-dialog {
    margin: 0.5rem;
  }
  
  .modal-body {
    padding: 1rem;
    max-height: calc(100vh - 150px);
  }
  
  .modal-body .row {
    flex-direction: column;
  }
  
  .col-md-6 {
    width: 100%;
  }
  
  .modal-footer {
    flex-direction: column;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
  }
  
  .modal-footer .btn {
    width: 100%;
    margin: 0;
  }
  
  .me-auto {
    margin-right: 0 !important;
    order: 1;
  }
  
  .form-label {
    font-size: 0.85rem;
  }
  
  .form-control, .form-select {
    font-size: 0.85rem;
  }
}
</style>

<script>
// Función para convertir texto natural a RRULE (misma que en crear)
function textoArruleEdit(texto) {
  texto = texto.toLowerCase().trim();
  
  const diasMap = {
    'lunes': 'MO',
    'martes': 'TU',
    'miércoles': 'WE',
    'miercoles': 'WE',
    'jueves': 'TH',
    'viernes': 'FR',
    'sábado': 'SA',
    'sabado': 'SA',
    'domingo': 'SU'
  };
  
  if (texto.includes('diario') || texto.includes('todos los días') || texto.includes('todos los dias')) {
    return 'FREQ=DAILY';
  }
  
  if (texto.includes('semanal')) {
    return 'FREQ=WEEKLY';
  }
  
  if (texto.includes('quincenal')) {
    return 'FREQ=WEEKLY;INTERVAL=2';
  }
  
  if (texto.includes('mensual')) {
    return 'FREQ=MONTHLY';
  }
  
  if (texto.includes('anual')) {
    return 'FREQ=YEARLY';
  }
  
  let diasEncontrados = [];
  for (let [dia, codigo] of Object.entries(diasMap)) {
    if (texto.includes(dia)) {
      diasEncontrados.push(codigo);
    }
  }
  
  if (diasEncontrados.length > 0) {
    return 'FREQ=WEEKLY;BYDAY=' + diasEncontrados.join(',');
  }
  
  return 'FREQ=WEEKLY';
}

// Función para convertir RRULE a texto legible (inverso)
function rruleATexto(rrule) {
  if (!rrule) return '';
  
  rrule = rrule.toUpperCase();
  
  if (rrule === 'FREQ=DAILY') {
    return 'diario';
  }
  
  if (rrule === 'FREQ=WEEKLY') {
    return 'semanal';
  }
  
  if (rrule === 'FREQ=WEEKLY;INTERVAL=2' || rrule === 'FREQ=WEEKLY;INTERVAL=2') {
    return 'quincenal';
  }
  
  if (rrule === 'FREQ=MONTHLY') {
    return 'mensual';
  }
  
  if (rrule === 'FREQ=YEARLY') {
    return 'anual';
  }
  
  // Detectar días específicos
  const diasMapInverso = {
    'MO': 'lunes',
    'TU': 'martes',
    'WE': 'miércoles',
    'TH': 'jueves',
    'FR': 'viernes',
    'SA': 'sábado',
    'SU': 'domingo'
  };
  
  const matchByday = rrule.match(/BYDAY=([A-Z,]+)/);
  if (matchByday) {
    const dias = matchByday[1].split(',');
    const diasTexto = dias.map(d => diasMapInverso[d] || d).join(' y ');
    return `todos los ${diasTexto}`;
  }
  
  return rrule.toLowerCase();
}

document.addEventListener('DOMContentLoaded', function() {
  const modalEditar = document.getElementById('modalEditarEvento');
  
  if (modalEditar) {
    modalEditar.addEventListener('show.bs.modal', function() {
      const recurrenteCheck = document.getElementById('edit_recurrente');
      const recurrenciaConfig = this.querySelector('.recurrencia-config');
      const reglaTexto = document.getElementById('edit_regla_texto');
      const reglaRecurrencia = document.getElementById('edit_regla_recurrencia');
      const rrulePreview = document.getElementById('edit-rrule-preview');
      const rruleText = document.getElementById('edit-rrule-text');
      
      if (recurrenteCheck && recurrenciaConfig) {
        recurrenciaConfig.style.display = recurrenteCheck.checked ? 'block' : 'none';
        
        recurrenteCheck.addEventListener('change', function() {
          recurrenciaConfig.style.display = this.checked ? 'block' : 'none';
          if (!this.checked) {
            reglaTexto.value = '';
            reglaRecurrencia.value = '';
            rrulePreview.style.display = 'none';
          }
        });
      }
      
      // Convertir RRULE existente a texto al cargar
      if (reglaRecurrencia && reglaRecurrencia.value && reglaTexto) {
        const textoLegible = rruleATexto(reglaRecurrencia.value);
        reglaTexto.value = textoLegible;
        rruleText.textContent = reglaRecurrencia.value;
        rrulePreview.style.display = 'block';
      }
      
      // Convertir texto a RRULE en tiempo real
      if (reglaTexto) {
        reglaTexto.addEventListener('input', function() {
          const texto = this.value.trim();
          if (texto) {
            const rrule = textoArruleEdit(texto);
            reglaRecurrencia.value = rrule;
            rruleText.textContent = rrule;
            rrulePreview.style.display = 'block';
          } else {
            reglaRecurrencia.value = '';
            rrulePreview.style.display = 'none';
          }
        });
      }
    });
  }
});
</script>