<?php
require_once '../controller/categoria_controller.php';

$categorias = new CategoriaController();

if(isset($_POST['modulo_categoria'])){
  if($_POST['modulo_categoria'] == "crear"){
    $categorias->crearCategoria();
  }else if($_POST['modulo_categoria'] == "eliminar"){
    $categorias->eliminarCategoria();
  }
}

if(isset($_GET['categorias'])){
  $categorias->obtenerCategorias();
}if(isset($_GET['categoriasPrivado'])){
  $categorias->obtenerCategoriasPrivado();
} 