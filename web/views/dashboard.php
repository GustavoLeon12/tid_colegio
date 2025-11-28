<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Dashboard</title>
</head>
<body>
  <div class="dashboard-container">
    <button class="external-toggle" id="external-toggle"><i class="fas fa-bars"></i></button>
    <?php include './components/sidebar.php'; ?>
    
    <div class="content" id="content">
      <!-- Header con filtros -->
      <div class="dashboard-header">
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
        <div class="filter-section">
          <label for="yearFilter">Año:</label>
          <select id="yearFilter">
            <option value="">Cargando...</option>
          </select>
        </div>
      </div>

      <!-- Tarjetas de estadísticas -->
      <div class="stats-grid">
        <div class="stat-card primary">
          <div class="stat-header">
            <div>
              <div class="stat-title">Total Noticias</div>
              <div class="stat-value" id="totalNoticias">0</div>
              <div class="stat-description">Noticias publicadas</div>
            </div>
            <div class="stat-icon">
              <i class="fas fa-newspaper"></i>
            </div>
          </div>
        </div>

        <div class="stat-card success">
          <div class="stat-header">
            <div>
              <div class="stat-title">Total Eventos</div>
              <div class="stat-value" id="totalEventos">0</div>
              <div class="stat-description">Eventos activos</div>
            </div>
            <div class="stat-icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
          </div>
        </div>

        <div class="stat-card warning">
          <div class="stat-header">
            <div>
              <div class="stat-title">Noticias Importantes</div>
              <div class="stat-value" id="noticiasImportantes">0</div>
              <div class="stat-description">Marcadas como importantes</div>
            </div>
            <div class="stat-icon">
              <i class="fas fa-star"></i>
            </div>
          </div>
        </div>

        <div class="stat-card info">
          <div class="stat-header">
            <div>
              <div class="stat-title">Eventos Recurrentes</div>
              <div class="stat-value" id="eventosRecurrentes">0</div>
              <div class="stat-description">Eventos que se repiten</div>
            </div>
            <div class="stat-icon">
              <i class="fas fa-redo"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Gráficos -->
      <div class="charts-grid">
        <div class="chart-card">
          <div class="chart-header">
            <div>
              <div class="chart-title">Noticias por Mes</div>
              <div class="chart-subtitle">Distribución mensual de noticias</div>
            </div>
          </div>
          <div class="chart-canvas">
            <canvas id="noticiasChart"></canvas>
          </div>
        </div>

        <div class="chart-card">
          <div class="chart-header">
            <div>
              <div class="chart-title">Eventos por Mes</div>
              <div class="chart-subtitle">Distribución mensual de eventos</div>
            </div>
          </div>
          <div class="chart-canvas">
            <canvas id="eventosChart"></canvas>
          </div>
        </div>

        <div class="chart-card">
          <div class="chart-header">
            <div>
              <div class="chart-title">Noticias por Categoría</div>
              <div class="chart-subtitle">Distribución por categorías</div>
            </div>
          </div>
          <div class="chart-canvas">
            <canvas id="categoriasChart"></canvas>
          </div>
        </div>

        <div class="chart-card">
          <div class="chart-header">
            <div>
              <div class="chart-title">Eventos por Estado</div>
              <div class="chart-subtitle">Distribución por estado</div>
            </div>
          </div>
          <div class="chart-canvas">
            <canvas id="estadosChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Actividad reciente -->
      <div class="activity-grid">
        <div class="activity-card">
          <div class="activity-header">
            <div class="activity-title">
              <i class="fas fa-newspaper"></i> Últimas Noticias
            </div>
          </div>
          <ul class="activity-list" id="ultimasNoticias">
            <li class="loading-container">
              <div class="spinner"></div>
            </li>
          </ul>
        </div>

        <div class="activity-card">
          <div class="activity-header">
            <div class="activity-title">
              <i class="fas fa-calendar-check"></i> Próximos Eventos
            </div>
          </div>
          <ul class="activity-list" id="proximosEventos">
            <li class="loading-container">
              <div class="spinner"></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/dashboard.js"></script>
</body>
</html>