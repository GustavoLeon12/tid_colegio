<?php
require_once '../controller/noticias_controller.php';

$noticia = new NoticiasController();
if(isset($_POST['modulo_noticia'])){
  if($_POST['modulo_noticia'] == "crear"){
    $noticia->crearNoticia();
  }else if($_POST['modulo_noticia'] == "obtener"){
    $noticia->obtenerNoticias();
  }else if($_POST['modulo_noticia'] == "eliminar"){
    $noticia->deleteNoticia();
  }  else if($_POST['modulo_noticia'] == "actualizar"){
    $noticia->updateNoticia();
  }else if($_POST['modulo_noticia'] == "obtener-privado"){
    $noticia->obtenerNoticiasPrivado();
  }
}
if(isset($_GET['id'])){
  $noticia->obtenerNoticia();
}