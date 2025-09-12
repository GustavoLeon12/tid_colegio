<?php
require '../../modelo/modelo_caja.php';

$MM = new ModeloCaja();

$consulta = $MM->listar();
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