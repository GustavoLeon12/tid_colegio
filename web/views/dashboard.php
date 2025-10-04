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
      <section class="news-section">
        <h2>Últimas Noticias</h2>
        <div class="news-card">
          <h5>Noticia de Ejemplo 1</h5>
          <p>Este es un ejemplo de una noticia. Aquí se mostrarán las noticias creadas desde administrar_noticias.php.</p>
          <small>Publicado: 01/10/2025</small>
        </div>
        <div class="news-card">
          <h5>Noticia de Ejemplo 2</h5>
          <p>Otro ejemplo de noticia para el dashboard.</p>
          <small>Publicado: 30/09/2025</small>
        </div>
      </section>
      <section class="calendar-section">
        <h2>Calendario Escolar</h2>
        <div class="calendar-placeholder">
          <p>Espacio reservado para el calendario escolar. Integrar con un widget o API de calendario (ej. FullCalendar).</p>
        </div>
      </section>
    </div>
  </div>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../lib/WOW/WOW.min.js"></script>
  <script src="../js/sidebar.js"></script>
</body>
</html>