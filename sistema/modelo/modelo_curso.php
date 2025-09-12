<?php
class Curso
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }



  function combo_cursos_libre()
  {

    $sql = "SELECT idcurso, nonbrecurso FROM curso WHERE statuscurso='LIBRE'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }

  }

  function Eliminar_Curso($idcurso)
  {

    $sql = "DELETE FROM curso WHERE idcurso = '$idcurso'";

    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }
  }
  function Listar_Curso()
  {
    $sql = "SELECT idcurso, cursoCodigo, nonbrecurso,  tipo, ic.nombreCat FROM curso as c INNER JOIN categoria_curso as ic on ic.id=c.fk_categoria";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

        $arreglo["data"][] = $consulta_VU;

      }
      return $arreglo;
      $this->conexion->cerrar();
    }

  }




  function Registrar_Curso($codigocur, $nombre, $tipo, $area)
  {

    $sql = "insert into curso(cursoCodigo, nonbrecurso, fechaRegistro,fechaActualizacion, tipo, fk_categoria) 
                 values ('$codigocur','$nombre',NOW(),NOW(),'$tipo', '$area')";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }

  }



  function Update_Curso($idcurso, $codigcurso, $nombre, $tipo, $area)
  {
    $sql = "update curso set cursoCodigo = '$codigcurso',nonbrecurso='$nombre',fechaActualizacion = NOW(),tipo='$tipo', fk_categoria='$area' WHERE idcurso= '$idcurso'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;

    } else {
      return 0;
    }



  }


}
?>