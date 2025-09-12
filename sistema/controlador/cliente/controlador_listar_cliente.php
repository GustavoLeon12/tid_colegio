<?php
require '../../modelo/modelo_cliente.php';

$MM = new ModeloCliente();

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