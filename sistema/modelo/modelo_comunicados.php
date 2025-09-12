<?php 
class Modelo_Comunicados{
  function __construct(){
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }
  function obtenerComunicados(){
    $sql = "
    SELECT b.fkCategoria ,b.id, b.fechaCreacion ,b.titulo, b.portada, b.descripcion, u.usu_apellidos as usuario, c.nombre as categoria FROM noticias b 
    LEFT JOIN categorias c ON c.id=b.fkCategoria
    LEFT JOIN usuarios u ON u.usu_id=b.fkUsuario
    WHERE c.privado=1";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo["data"][]=$consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }
  }
  
  function obtenerComunicado($id){
    $sql = "
    SELECT b.fkCategoria ,b.id, b.fechaCreacion ,b.titulo, b.portada, b.descripcion, u.usu_apellidos as usuario, c.nombre as categoria FROM noticias b 
    LEFT JOIN categorias c ON c.id=b.fkCategoria
    LEFT JOIN usuarios u ON u.usu_id=b.fkUsuario
    WHERE b.id=$id";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo["data"][]=$consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }
  }
}
?>