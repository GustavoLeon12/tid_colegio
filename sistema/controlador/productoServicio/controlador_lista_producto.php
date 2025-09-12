<?php
require '../../modelo/modelo_producto_servicio.php';

$MM = new ModeloProductoServicio();

$id = $_GET['id'];

$consulta = $MM->listaProductos($id);
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