<?php
    require dirname(__DIR__, 2) . '/modelo/modelo_usuario.php';

    $MU = new Modelo_Usuario();
    $iddocente = htmlspecialchars($_POST['iddocente'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Extraer_Datos_docente_Seleccionado($iddocente);
   echo json_encode($consulta);

?>