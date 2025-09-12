<?php
require '../../modelo/modelo_producto_servicio.php';

$MM = new ModeloProductoServicio();

$consulta = $MM->listarProductos();
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