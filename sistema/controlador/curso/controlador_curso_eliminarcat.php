<?php
   require '../../modelo/modelo_categoria.php';

    $categoria = new Categoria();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
   
     $consulta = $categoria->Eliminar_Cat($id);
    echo $consulta;

?>