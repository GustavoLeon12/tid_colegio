<?php
require '../../../global.php';

class ModeloProductoServicio
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  function listarProductos()
  {
    $sql = "SELECT * FROM producto_servicio";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }
  function listaProductos($id)
  {
    $sql = "SELECT * FROM producto_servicio WHERE idproducto_servicio='$id'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
    }
  }

  function registrarProducto($descripcion, $detalle, $modelo, $unidad, $moneda, $stockInicial, $stockMinimo, $tipoFacturacion, $fechaVencimiento, $precioBaseUnitario, $identificado, $igvUnitario, $precioFinal, $marcaId, $categoriaProductoId)
  {
    $sql = "
      INSERT INTO producto_servicio 
      (descripcion, 
      detalle, 
      modelo, 
      unidad, 
      moneda, 
      stock_inicial,
      stock_minimo, 
      tipo_facturacion, 
      fecha_vencimiento, 
      precio_base_unitario, 
      identificado, 
      igv_unitario,
      precio_final, 
      marca_id_marca, 
      categoria_producto_idcategoria_producto) 
      VALUES 
      ('$descripcion', 
      '$detalle', 
      '$modelo', 
      '$unidad', 
      '$moneda', 
      '$stockInicial',
      '$stockMinimo', 
      '$tipoFacturacion', 
      '$fechaVencimiento', 
      '$precioBaseUnitario', 
      '$identificado', 
      '$igvUnitario', 
      '$precioFinal', 
      '$marcaId', 
      '$categoriaProductoId');
    ";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }

  function actualizarMarca($descripcion, $id)
  {
    $sql = "UPDATE producto_servicio set descripcion='$descripcion' WHERE id_marca= '$id'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;

    } else {
      return 0;
    }
  }

  function eliminarProducto($id)
  {
    $sql = "DELETE FROM producto_servicio WHERE idproducto_servicio = '$id'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
}

?>