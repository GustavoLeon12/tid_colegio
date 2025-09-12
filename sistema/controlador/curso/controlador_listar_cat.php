<?php
require '../../modelo/modelo_categoria.php';
$categoria = new Categoria();
$consulta = $categoria->Listar_Cat();
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