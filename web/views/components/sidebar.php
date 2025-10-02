<?php
// sidebar.php - Added toggle button at the bottom
?>
<div class="admin-sidebar visible">
  <img src="../img/LOGO.png" alt="Logo de Colegio Orion">
  <ul>
    <li><a href="./crear_noticia.php"><i class="fas fa-plus-circle"></i> Crear Noticias</a></li>
    <li><a href="./administrar_noticias.php"><i class="fas fa-edit"></i> Administrar Noticias</a></li>
    <li><a href="./index.php" target="_blank"><i class="fas fa-home"></i> Volver a la Página Web</a></li>
    <li><a href="#" class="close__session"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
  </ul>
  <button class="toggle-sidebar" id="toggle-sidebar"><i class="fas fa-bars"></i></button>
</div>