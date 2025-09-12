
<?php
  require '../../modelo/modelo_categoria.php';


    $categoria = new Categoria();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $codigocat = htmlspecialchars($_POST['codigocat'],ENT_QUOTES,'UTF-8');
    $nombrecat = htmlspecialchars($_POST['nombrecat'],ENT_QUOTES,'UTF-8');
  
   $consulta = $categoria->Update_Cat($id,$codigocat,$nombrecat);
    echo $consulta;

?>