<?php
require_once '../controller/noticias_controller.php';

$noticia = new NoticiasController();

// Manejo de peticiones POST
if (isset($_POST['modulo_noticia'])) {
  if ($_POST['modulo_noticia'] == "crear") {
    $noticia->crearNoticia();
  } else if ($_POST['modulo_noticia'] == "obtener") {
    $noticia->obtenerNoticias();
  } else if ($_POST['modulo_noticia'] == "eliminar") {
    $noticia->deleteNoticia();
  } else if ($_POST['modulo_noticia'] == "actualizar") {
    $noticia->updateNoticia();
  } else if ($_POST['modulo_noticia'] == "obtener-privado") {
    $noticia->obtenerNoticiasPrivado();
  } else if ($_POST['modulo_noticia'] == "generar-pdf") {
    // Redirigir directamente a reporte_noticias.php
    $categoria = $_POST["categoria"] ?? 'todas';
    $estado = $_POST["estado"] ?? 'todas';
    $noticias_ids = $_POST["noticias_ids"] ?? '[]';

    session_start();
    $_SESSION['reporte_categoria'] = $categoria;
    $_SESSION['reporte_estado'] = $estado;
    $_SESSION['reporte_noticias_ids'] = $noticias_ids;

    header('Location: ../views/reportes/reporte_noticias.php');
    exit;
  } else if ($_POST['modulo_noticia'] == "generar-excel") {
    $noticia->generarExcel();
  } else if ($_POST['modulo_noticia'] == "categorias-con-conteo") {
    $noticia->obtenerCategoriasConConteo();
  }
}

// Manejo de peticiones GET
if (isset($_GET['id'])) {
  $noticia->obtenerNoticia();
} else if (isset($_GET['modulo'])) {
  if ($_GET['modulo'] == "categorias-con-conteo") {
    $noticia->obtenerCategoriasConConteo();
  }
}