<?php
require '../../../global.php';

class ModeloCaja
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
    $sql = "SELECT * FROM caja";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }

  function registrar($montoInicial, $apertura, $cierre, $montoFinal, $montoReferencial, $codSucursal, $usuario)
  {
    $sql = "INSERT INTO caja (montoinicial, apertura, cierre, monto_final, monto_referencial, cod_sucursal, usuario_id_usuario, abierto) VALUES ('$montoInicial', '$apertura', '$cierre', '$montoFinal', '$montoReferencial', '$codSucursal', '$usuario', 0);";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizar($id, $abierto)
  {
    if($abierto === "0"){
      $sql = "UPDATE caja set abierto='1'  WHERE id_caja= '$id'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      } else {
        return 0;
      }
    }else{
      $sql = "UPDATE caja set abierto='0'  WHERE id_caja= '$id'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      } else {
        return 0;
      }
    }


  }
}

?>