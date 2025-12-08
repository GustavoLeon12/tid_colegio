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
                <label class="form-label fw-semibold">Color del Evento</label>
                <div class="d-flex align-items-center">
                  <input type="color" name="color" class="form-control form-control-color me-2" value="#2196F3" style="width: 60px; height: 38px;">
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
                    <select name="usuario_id" class="form-select">
                      <option value="">-- Seleccione Docente * --</option>
                      <?php foreach ($docentes as $doc): ?>
                        <option value="<?= $doc['id_docente'] ?>"><?= htmlspecialchars($doc['nombre_completo']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="grado_id" class="form-select">
                      <option value="">-- Grado * --</option>
                      <?php foreach ($grados as $grado): ?>
                        <option value="<?= $grado['idgrado'] ?>"><?= htmlspecialchars($grado['gradonombre']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="curso_id" class="form-select">
                      <option value="">-- Curso * --</option>
                      <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['idcurso'] ?>"><?= htmlspecialchars($curso['nonbrecurso']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="aula_id" class="form-select">
                      <option value="">-- Aula * --</option>
                      <?php foreach ($aulas as $aula): ?>
                        <option value="<?= $aula['idaula'] ?>"><?= htmlspecialchars($aula['nombreaula']) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-6 mb-2">
                    <select name="year_id" class="form-select" required>
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
                  <label class="form-label small">Describe la frecuencia del evento</label>
                  <input type="text" id="regla_texto" class="form-control mb-2" placeholder="Ej: todos los lunes, diario, quincenal">
                  <input type="hidden" name="regla_recurrencia" id="regla_recurrencia">
                  <div class="form-text small">
                    Ejemplos válidos: <br>
                    <code>todos los lunes</code> - Cada lunes<br>
                    <code>diario</code> - Todos los días<br>
                    <code>quincenal</code> - Cada 15 días<br>
                    <code>todos los miércoles y viernes</code> - Miércoles y Viernes
                  </div>
                  <div id="rrule-preview" class="alert alert-info mt-2" style="display: none; font-size: 0.75rem;">
                    <strong>RRULE generada:</strong> <span id="rrule-text"></span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
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
  // Función para convertir texto natural a RRULE
  function textoArrule(texto) {
    texto = texto.toLowerCase().trim();
    
    // Patrones de días de la semana
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
    
    // Detectar frecuencias
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
    
    // Detectar días específicos
    let diasEncontrados = [];
    for (let [dia, codigo] of Object.entries(diasMap)) {
      if (texto.includes(dia)) {
        diasEncontrados.push(codigo);
      }
    }
    
    if (diasEncontrados.length > 0) {
      return 'FREQ=WEEKLY;BYDAY=' + diasEncontrados.join(',');
    }
    
    // Si no se reconoce el patrón, usar semanal por defecto
    return 'FREQ=WEEKLY';
  }

  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalNuevoEvento');

    modal.addEventListener('shown.bs.modal', function() {
      const recurrenteCheck = modal.querySelector('#recurrenteCheck');
      const recurrenciaConfig = modal.querySelector('.recurrencia-config');
      const reglaTexto = modal.querySelector('#regla_texto');
      const reglaRecurrencia = modal.querySelector('#regla_recurrencia');
      const rrulePreview = modal.querySelector('#rrule-preview');
      const rruleText = modal.querySelector('#rrule-text');

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

      // Convertir texto a RRULE en tiempo real
      if (reglaTexto) {
        reglaTexto.addEventListener('input', function() {
          const texto = this.value.trim();
          if (texto) {
            const rrule = textoArrule(texto);
            reglaRecurrencia.value = rrule;
            rruleText.textContent = rrule;
            rrulePreview.style.display = 'block';
          } else {
            reglaRecurrencia.value = '';
            rrulePreview.style.display = 'none';
          }
        });
      }

      // Auto-completar fecha fin
      const fechaInicio = modal.querySelector('input[name="fecha_inicio"]');
      const fechaFin = modal.querySelector('input[name="fecha_fin"]');

      if (fechaInicio && fechaFin) {
        fechaInicio.addEventListener('change', function() {
          if (!fechaFin.value) {
            const inicioDate = new Date(this.value);
            inicioDate.setHours(inicioDate.getHours() + 1);
            fechaFin.value = inicioDate.toISOString().slice(0, 16);
          }
        });
      }
    });

    // Limpiar formulario al cerrar
    modal.addEventListener('hidden.bs.modal', function() {
      const form = modal.querySelector('#formNuevoEvento');
      if (form) {
        form.reset();
        modal.querySelector('.recurrencia-config').style.display = 'none';
        modal.querySelector('#rrule-preview').style.display = 'none';
      }
    });
  });
</script>