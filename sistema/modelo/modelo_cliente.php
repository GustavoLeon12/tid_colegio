<?php
require '../../../global.php';

class ModeloCliente
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listar()
  {
    $sql = "SELECT * FROM cliente";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    } 
  }

  function registrar($nombre, $apellido, $correo, $telefono, $documento, $direccion, $fkUbigeo, $fkTpDocu, $tipo)
  {
    $sql = "INSERT INTO cliente (nombre, apellido, correo, telefono, documento, direccion, fk_ubigeo, fk_tp_docu, tipo) VALUES 
    ('$nombre', '$apellido', '$correo', '$telefono', '$documento', '$direccion', '$fkUbigeo', '$fkTpDocu', '$tipo') 
    ";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizar($id, $nombre, $apellido, $correo, $telefono, $documento, $direccion, $fkUbigeo, $fkTpDocu, $tipo)
  {
    $sql = "UPDATE cliente set nombre='$nombre', apellido='$apellido', correo='$correo', telefono='$telefono', documento='$documento', direccion='$direccion', fk_ubigeo='$fkUbigeo', fk_tp_docu='$fkTpDocu', tipo='$tipo'  WHERE id_usuario= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function eliminar($id)
  {
    $sql = "DELETE FROM cliente WHERE id_usuario = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
}

?>