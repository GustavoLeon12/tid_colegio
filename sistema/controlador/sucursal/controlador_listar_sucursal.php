<?php
require '../../modelo/modelo_sucursal.php';

$MM = new ModeloSucursal();

$consulta = $MM->listarSucursal();
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