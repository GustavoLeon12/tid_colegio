<!-- Modal Crear Nuevo Evento -->
<div class="modal fade" id="modalNuevoEvento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Registrar Nuevo Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formNuevoEvento" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label>Nombre del Evento</label>
            <input type="text" name="titulo" class="form-control" placeholder="Ej: Ceremonia de apertura" required>
          </div>

          <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="2"></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Fecha Inicio</label>
              <input type="datetime-local" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Fecha Fin</label>
              <input type="datetime-local" name="fecha_fin" class="form-control">
            </div>
          </div>

          <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control">
          </div>

          <div class="mb-3">
            <label>Color del Evento</label><br>
            <div class="d-flex flex-wrap gap-2">
              <?php
              $colores = ['#FF5722','#FFC107','#8BC34A','#009688','#2196F3','#9c27b0'];
              foreach ($colores as $c): ?>
                <input type="radio" name="color" id="color<?= str_replace('#','',$c) ?>" value="<?= $c ?>" class="btn-check" <?= $c == '#2196F3' ? 'checked' : '' ?>>
                <label for="color<?= str_replace('#','',$c) ?>" class="btn btn-sm" style="background-color: <?= $c ?>; width: 25px; height: 25px; border-radius: 50%;"></label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="mb-3">
            <label>Grado / Sección</label>
            <select name="gradoid" class="form-select">
              <option value="">-- Seleccione --</option>
              <?php
              // ejemplo dinámico: reemplazar por consulta real a tu tabla grados
              // foreach ($grados as $g) echo "<option value='{$g['id']}'>{$g['nombre']}</option>";
              ?>
            </select>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="todo_dia" value="1" id="todo_dia">
            <label class="form-check-label" for="todo_dia">Todo el día</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal Crear Nuevo Evento -->