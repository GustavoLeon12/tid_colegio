
<?php
    require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

     $finicio = htmlspecialchars($_POST['finicio'],ENT_QUOTES,'UTF-8');
     $fFinal = htmlspecialchars($_POST['fFinal'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->listar_Reportes_PorFechas($finicio, $fFinal);
  
     if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

?>