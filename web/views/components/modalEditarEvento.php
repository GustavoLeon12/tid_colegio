<!-- Modal Editar Evento -->
<div class="modal fade" id="modalEditarEvento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Editar Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formEditarEvento" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">

          <div class="mb-3">
            <label>Título *</label>
            <input type="text" name="titulo" id="edit_titulo" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Fecha Inicio *</label>
              <input type="datetime-local" name="fecha_inicio" id="edit_fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Fecha Fin</label>
              <input type="datetime-local" name="fecha_fin" id="edit_fecha_fin" class="form-control">
            </div>
          </div>

          <div class="mb-3">
            <label>Todo el Día</label>
            <input type="checkbox" name="todo_dia" id="edit_todo_dia" value="1" class="form-check-input">
          </div>

          <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" id="edit_ubicacion" class="form-control">
          </div>

          <div class="mb-3">
            <label>Categoría ID</label>
            <select name="categoria_id" id="edit_categoria_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="1">Evento General</option>
              <option value="2">Clase</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Usuario ID (Docente)</label>
            <select name="usuario_id" id="edit_usuario_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="1">Docente 1</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Grado ID</label>
            <select name="grado_id" id="edit_grado_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="1">1° Primaria</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Curso ID</label>
            <select name="curso_id" id="edit_curso_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="1">Matemáticas</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Aula ID</label>
            <select name="aula_id" id="edit_aula_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="1">Aula 101</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Año ID (Year)</label>
            <select name="year_id" id="edit_year_id" class="form-select">
              <option value="">-- Seleccione --</option>
              <option value="2025">2025</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Recurrente</label>
            <input type="checkbox" name="recurrente" id="edit_recurrente" value="1" class="form-check-input">
          </div>

          <div class="mb-3">
            <label>Regla de Recurrencia (RRULE)</label>
            <input type="text" name="regla_recurrencia" id="edit_rrule" class="form-control">
          </div>

          <div class="mb-3">
            <label>Color</label>
            <input type="color" name="color" id="edit_color" class="form-control form-control-color" value="#2196F3">
          </div>

          <div class="mb-3">
            <label>Estado</label>
            <select name="estado" id="edit_estado" class="form-select">
              <option value="ACTIVO">Activo</option>
              <option value="INACTIVO">Inactivo</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" id="btnEliminarEvento" class="btn btn-danger me-auto">Eliminar</button>
          <button type="submit" class="btn btn-warning text-white">Actualizar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal Editar Evento -->