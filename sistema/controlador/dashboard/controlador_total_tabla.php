
<?php
    require '../../modelo/modelo_dashboard.php';
    $dashboard = new ModeloDashboard();
     $consulta = $dashboard->totaltabla();
    if($consulta){
        echo json_encode($consulta);
    }else{
    
            echo '[]';
    
    }
    

    

?>
