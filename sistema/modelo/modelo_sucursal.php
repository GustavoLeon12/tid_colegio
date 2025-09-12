<?php
require '../../../global.php';

class ModeloSucursal
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listarSucursal()
  {
    $sql = "SELECT * FROM sucursal";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }

  function registrarSucursal($codigoSucursal, $denominacion, $direccion, $ubigeo, $codigoSunat, $activo)
  {
    $sql = "INSERT INTO sucursal (cod_sucursal, denominacion, direccion, ubigeo, cod_sunat, activo ) VALUES ( '$codigoSucursal', '$denominacion', '$direccion', '$ubigeo', '$codigoSunat', '$activo');";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizarSucursal($id, $codigoSucursal, $denominacion, $direccion, $ubigeo, $codigoSunat, $activo)
  {
    $sql = "UPDATE sucursal set cod_sucursal='$codigoSucursal',denominacion='$denominacion',direccion='$direccion',ubigeo='$ubigeo',cod_sunat='$codigoSunat',activo='$activo'  WHERE id_sucursal= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function eliminarSucursal($id)
  {
    $sql = "DELETE FROM sucursal WHERE id_sucursal = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
}

?>