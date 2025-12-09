<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Administrar Calendario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/administrar_calendario.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.bubble.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
</head>

<body>
  <?php require_once './components/modalEditarEvento.php';
  require_once './components/modalNuevoEvento.php'; ?>
  <div class="dashboard-container">
    <button class="external-toggle" id="external-toggle"><i class="fas fa-bars"></i></button>
    <?php require_once './components/sidebar.php'; ?>
    <div class="content" id="content">
      <div class="header">
        <h3>Administrar Calendario</h3>
        <p>Edita, elimina o visualiza los eventos.</p>
      </div>
       <!-- Sección de Filtros -->
      <div class="filtros-section">
        <h4><i class="fas fa-filter"></i> Filtros de Búsqueda</h4>
        <div class="filtros-grid">
          <div class="filtro-group">
            <label for="filtro-docente">Docente:</label>
            <select id="filtro-docente" class="form-select">
              <option value="">Todos los docentes</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-grado">Grado:</label>
            <select id="filtro-grado" class="form-select">
              <option value="">Todos los grados</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-curso">Curso:</label>
            <select id="filtro-curso" class="form-select">
              <option value="">Todos los cursos</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-aula">Aula:</label>
            <select id="filtro-aula" class="form-select">
              <option value="">Todas las aulas</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-year">Año Escolar:</label>
            <select id="filtro-year" class="form-select">
              <option value="">Todos los años</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-estado">Estado:</label>
            <select id="filtro-estado" class="form-select">
              <option value="">Todos los estados</option>
            </select>
          </div>
          
          <div class="filtro-group">
            <label for="filtro-fecha-desde">Fecha Desde:</label>
            <input type="date" id="filtro-fecha-desde" class="form-control">
          </div>
          
          <div class="filtro-group">
            <label for="filtro-fecha-hasta">Fecha Hasta:</label>
            <input type="date" id="filtro-fecha-hasta" class="form-control">
          </div>
        </div>
        
        <div class="filtros-actions">
          <button type="button" id="btnAplicarFiltros" class="btn-filtro btn-filtro-aplicar">
            <i class="fas fa-search"></i> Aplicar Filtros
          </button>
          <button type="button" id="btnLimpiarFiltros" class="btn-filtro btn-filtro-limpiar">
            <i class="fas fa-eraser"></i> Limpiar Filtros
          </button>
          
          <div class="exportar-section">
            <button type="button" id="btnExportarPDF" class="btn-exportar btn-exportar-pdf">
              <i class="fas fa-file-pdf"></i> Exportar PDF
            </button>
            <button type="button" id="btnExportarExcel" class="btn-exportar btn-exportar-excel">
              <i class="fas fa-file-excel"></i> Exportar Excel
            </button>
          </div>
        </div>
        
        <div class="contador-eventos" id="contadorEventos">
          <i class="fas fa-calendar-check"></i>
          <span id="textoContador">Mostrando todos los eventos</span>
        </div>
      </div>
      <div class="table-container">
        <div class="table-header">
          <h3 class="table-title">Gestión de Eventos</h3>
          <div class="table-controls">
            <button id="btnNuevoEvento" class="btn btn-primary">
              <i class="fas fa-plus me-2"></i>Nuevo Evento
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table id="tablaCalendario" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Ubicación</th>
                <th>Docente</th>
                <th>Grado</th>
                <th>Curso</th>
                <th>Aula</th>
                <th>Año</th>
                <th>Recurrente</th>
                <th>RRULE</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Actualizado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Notificación -->
<div class="modal fade" id="modalNotificacion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Enviar Notificación por Email</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="notif_id" value="">
        <input type="hidden" id="notif_titulo" value="">
        <input type="hidden" id="notif_descripcion" value="">
        <input type="hidden" id="notif_fecha_inicio" value="">
        <input type="hidden" id="notif_fecha_fin" value="">
        <div class="mb-3">
          <label class="form-label">Destinatarios (emails separados por coma)</label>
          <textarea id="destinatarios" class="form-control" rows="3" placeholder="user@gmail.com, otro@gmail.com"></textarea>
        </div>
        <div class="d-grid">
          <button type="button" id="btnEnviarNotif" class="btn btn-primary">Enviar</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Notificación -->

  <script src="../js/sidebar.js"></script>
  <script src="../js/administrar_calendario.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>


</body>

</html>