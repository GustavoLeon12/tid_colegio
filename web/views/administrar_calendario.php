<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Administrar Calendario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/animaciones.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/administrar_noticias.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.bubble.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
</head>

<body>
  <?php
  require_once './components/modal_delete.php';
  require_once './components/modal_update.php';
  ?>
  <div class="dashboard-container">
    <button class="external-toggle" id="external-toggle"><i class="fas fa-bars"></i></button>
    <?php require_once './components/sidebar.php'; ?>
    <div class="content" id="content">
      <div class="header">
        <h3>Administrar Calendario</h3>
        <p>Edita, elimina o visualiza los eventos de la comunidad educativa.</p>
      </div>