<?php
require '../../modelo/modelo_categoria_producto.php';

$MM = new ModeloCategoria();

$consulta = $MM->listarCategorias();
if ($consulta) {
  echo json_encode($consulta);
} else {
  echo '{
      "sEcho": 1,
      "iTotalRecords": "0",
      "iTotalDisplayRecords": "0",
      "aaData": []
  }';
}
?>