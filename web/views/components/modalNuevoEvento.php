<!-- Modal Crear Nuevo Evento -->
<?php
require_once __DIR__ . '/../../models/calendario_model.php';
$model = new CalendarioModel();
$docentes = $model->obtenerDocentes();
$grados = $model->obtenerGrados();
$cursos = $model->obtenerCursos();
$aulas = $model->obtenerAulas();
$years = $model->obtenerYears();
$estados = $model->obtenerEstados();
?>
<div class="modal fade" id="modalNuevoEvento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Registrar Nuevo Evento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formNuevoEvento" method="POST">
        <div class="modal-body">
          <div class="row">
            <!-- Columna Izquierda - Información Principal -->
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label fw-semibold">Título <span class="text-danger">*</span></label>
                <input type="text" name="titulo" class="form-control" required placeholder="Ingrese el título del evento">
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción del evento"></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" placeholder="Lugar donde se realizará el evento">
              </div>

              <div class="row">
                <div class="col-12 mb-3">
                  <label class="form-label fw-semibold">Fechas del Evento</label>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label small">Fecha Inicio <span class="text-danger">*</span></label>
                  <input type="datetime-local" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label small">Fecha Fin</label>
                  <input type="datetime-local" name="fecha_fin" class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check form-switch">
                  <input type="checkbox" name="todo_dia" value="1" class="form-check-input" id="todoDiaCheck">
                  <label class="form-check-label fw-semibold" for="todoDiaCheck">Todo el Día</label>
                </div>
              </div>
            </div>

            <!-- Columna Derecha - Configuraciones Adicionales -->
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label fw-semibold">Información Académica</label>
                <div class="row g-2">
                  <div class="col-12 mb-2">
                    <select name="usuario_id" class="form-select">
                      <option value="">-- Seleccione Docente --</option>
                      <?php foreach ($docentes as $doc): ?>
                        <option value="<?= $doc['id_docente'] ?>"><?= htmlspecialchars($doc['nombre_completo']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="grado_id" class="form-select">
                      <option value="">-- Grado --</option>
                      <?php foreach ($grados as $grado): ?>
                        <option value="<?= $grado['idgrado'] ?>"><?= htmlspecialchars($grado['gradonombre']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="curso_id" class="form-select">
                      <option value="">-- Curso --</option>
                      <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['idcurso'] ?>"><?= htmlspecialchars($curso['nonbrecurso']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="aula_id" class="form-select">
                      <option value="">-- Aula --</option>
                      <?php foreach ($aulas as $aula): ?>
                        <option value="<?= $aula['idaula'] ?>"><?= htmlspecialchars($aula['nombreaula']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="year_id" class="form-select">
                      <option value="">-- Año Escolar --</option>
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
                  <input type="checkbox" name="recurrente" value="1" class="form-check-input" id="recurrenteCheck">
                  <label class="form-check-label" for="recurrenteCheck">Evento Recurrente</label>
                </div>
                <div class="recurrencia-config" style="display: none;">
                  <label class="form-label small">Regla de Recurrencia (RRULE)</label>
                  <input type="text" name="regla_recurrencia" class="form-control" placeholder="Ej: FREQ=WEEKLY;BYDAY=MO">
                  <div class="form-text small">
                    Ejemplos: <br>
                    <code>FREQ=DAILY</code> - Diariamente<br>
                    <code>FREQ=WEEKLY;BYDAY=MO,WE,FR</code> - Lunes, Miércoles, Viernes<br>
                    <code>FREQ=MONTHLY;BYMONTHDAY=15</code> - Cada día 15 del mes
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Color del Evento</label>
                  <div class="d-flex align-items-center">
                    <input type="color" name="color" class="form-control form-control-color me-2" value="#2196F3" style="width: 60px; height: 38px;">
                    <span class="small text-muted">Color de visualización</span>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Estado <span class="text-danger">*</span></label>
                  <select name="estado" class="form-select" required>
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($estados as $estado): ?>
                      <option value="<?= htmlspecialchars($estado) ?>">
                        <?= ucfirst(strtolower($estado)) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>Cancelar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save me-1"></i>Guardar Evento
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal Crear Nuevo Evento -->

<style>
  .modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  }

  .modal-header {
    border-radius: 12px 12px 0 0;
    padding: 1.2rem 1.5rem;
  }

  .modal-body {
    padding: 1.5rem;
  }

  .modal-footer {
    border-top: 1px solid #dee2e6;
    padding: 1rem 1.5rem;
  }

  .form-label {
    color: #495057;
    margin-bottom: 0.5rem;
  }

  .form-control,
  .form-select {
    border-radius: 6px;
    border: 1px solid #ced4da;
    transition: all 0.2s ease;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #2196F3;
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
  }

  .form-check-input:checked {
    background-color: #2196F3;
    border-color: #2196F3;
  }

  .form-switch .form-check-input {
    width: 2.5em;
    margin-right: 0.5rem;
  }

  .recurrencia-config {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 6px;
    border-left: 4px solid #2196F3;
  }

  .form-text code {
    background: #e9ecef;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.8em;
  }

  .btn {
    border-radius: 6px;
    padding: 0.5rem 1.2rem;
    font-weight: 500;
  }

  .btn-success {
    background-color: #28a745;
    border-color: #28a745;
  }

  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .modal-dialog {
      margin: 1rem;
    }

    .modal-body .row {
      flex-direction: column;
    }

    .col-md-6 {
      width: 100%;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle recurrencia config
    const recurrenteCheck = document.getElementById('recurrenteCheck');
    const recurrenciaConfig = document.querySelector('.recurrencia-config');

    if (recurrenteCheck && recurrenciaConfig) {
      recurrenteCheck.addEventListener('change', function() {
        recurrenciaConfig.style.display = this.checked ? 'block' : 'none';
      });
    }

    // Auto-completar fecha fin si está vacía
    const fechaInicio = document.querySelector('input[name="fecha_inicio"]');
    const fechaFin = document.querySelector('input[name="fecha_fin"]');

    if (fechaInicio && fechaFin) {
      fechaInicio.addEventListener('change', function() {
        if (!fechaFin.value) {
          // Establecer fecha fin 1 hora después de fecha inicio por defecto
          const inicioDate = new Date(this.value);
          inicioDate.setHours(inicioDate.getHours() + 1);
          fechaFin.value = inicioDate.toISOString().slice(0, 16);
        }
      });
    }
  });
</script>