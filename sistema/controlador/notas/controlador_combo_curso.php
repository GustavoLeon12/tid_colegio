

<?php
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();
    $gradoid = htmlspecialchars($_POST['gradoid'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Listar_combo_Cursos_grado($gradoid);
    echo json_encode($consulta);
?>