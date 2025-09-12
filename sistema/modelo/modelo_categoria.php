<?php
// TODO: Crear funciones para hacer un crud de las categorias de un curso.

class Categoria
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }



  function Eliminar_Cat($id)
  {

    $sql = "DELETE FROM categoria_curso WHERE id = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
  function Listar_Cat()
  {
    $sql = "SELECT id, categoriaCodigo, nombrecat FROM categoria_curso";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

        $arreglo["data"][] = $consulta_VU;

      }
      return $arreglo;
      $this->conexion->cerrar();
    }

  }



  function Registrar_Cat($codigocat, $nombrecat)
  {

    $sql = "insert into categoria_curso(categoriaCodigo, nombrecat, fechaRegistro,fechaActualizacion) 
                 values ('$codigocat','$nombrecat',NOW(),NOW())";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }

  }



  function Update_Cat($id, $codigocat, $nombrecat)
  {
    $sql = "update categoria_curso set categoriaCodigo = '$codigocat',nombrecat='$nombrecat',fechaActualizacion = NOW() WHERE id= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;

    } else {
      return 0;
    }



  }


}
?>