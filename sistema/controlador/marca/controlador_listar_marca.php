<?php
require '../../modelo/modelo_marca.php';

$MM = new ModeloMarca();

$consulta = $MM->listarMarcas();
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