<?php
require '../../../global.php';

class ModeloCategoria
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listarCategorias()
  {
    $sql = "SELECT * FROM categoria_producto";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }

  function registrarCategorias($descripcion, $detalle, $fechaCreacion)
  {
    $sql = "INSERT INTO categoria_producto (descripcion, detalle ,fecha_creacion) VALUES ('$descripcion', '$detalle','$fechaCreacion')";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizarCategorias($descripcion, $detalle, $id)
  {
    $sql = "UPDATE categoria_producto set descripcion='$descripcion',detalle='$detalle' WHERE idcategoria_producto= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function eliminarCategorias($id)
  {
    $sql = "DELETE FROM categoria_producto WHERE idcategoria_producto = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
}

?>