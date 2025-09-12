<?php
require '../../../global.php';

class ModeloMarca
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listarMarcas()
  {
    $sql = "SELECT * FROM marca";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }

  function registrarMarca($descripcion, $fechaCreacion)
  {
    $sql = "INSERT INTO marca (descripcion, fecha_creacion) VALUES ('$descripcion', '$fechaCreacion')";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizarMarca($descripcion, $id)
  {
    $sql = "UPDATE marca set descripcion='$descripcion' WHERE id_marca= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;

    } else {
      return 0;
    }
  }

  function eliminarMarca($id)
  {
    $sql = "DELETE FROM marca WHERE id_marca = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
}

?>