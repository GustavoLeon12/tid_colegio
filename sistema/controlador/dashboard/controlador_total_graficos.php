
<?php
    require '../../modelo/modelo_dashboard.php';
    $dashboard = new ModeloDashboard();
     $consulta = $dashboard->cursograficos();
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
