<?php
class Nota{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }



    function listar_alumnosParaPonerNotas($idgrado,$idnivel, $idyear, $idsecion){
       $sql = "select idalumno,apellidos,alumnonombre FROM matricula
inner join alumno on alumno.idalumno =matricula.Id_alumno
 WHERE Id_grado='$idgrado'and Id_nivls='$idnivel'and year_id='$idyear' and seccion='$idsecion'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }
}

function ListarPeriodoDeEvaluacionSusFechas($idyear){
$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final FROM periodo
inner join tipoevaluacion on tipoevaluacion.tipo_id =periodo.tipo_periodo where year_id='$idyear'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }

}


//FUNCION CLAVE DONDE SE ESPECIFICA LAS NOTAS DE LOA ALUMNOS
function listar_alumnos_Notas($tipoorden,$tipoid,$cursoid,$idgrado,$idsecion,$idnivel,$idyear){
  /* $sql = "select a.idalumno, a.apellidop ,n.nota_alum from alumno 
   as a left join notas as n on a.idalumno = n.alumnoid
   where grado='1';";*/
    $sql = "select n.idnotas,a.idalumno, a.apellidos ,n.nota_alum from notas 
   as n join alumno as a on a.idalumno = n.alumnoid
   where gradoid='$idgrado' and cursoid='$cursoid' and seccionid='$idsecion'  and ordentipo='$tipoorden'
   and tipoevaluacionid='$tipoid' and idnivel='$idnivel' and yearid='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}

//LISTANDO CARGA ACADEMICO POR CADAD TIPO BIMESTRE O TREM O SEMSTRE 
function listar_CargaAcademicaPorCadaCursoPorTipo($idcurso,$tipoorden,$tipoid,$idyear){

   $sql = "SELECT actcur_id,actividades,puntajes FROM activ_curso where cursoid='$idcurso' and ordenTipoeva='$tipoorden' and evalu_tipo='$tipoid'  and yearId='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}

  //REGISTRAR NOTAS aLUMNO
function Registrar_Notas_Alumno($alumnos,$actividad,$nota,$cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel,$iddocente){

   $sql = "INSERT INTO notas( gradoid, cursoid, alumnoid, seccionid,cargaacadId, ordentipo, tipoevaluacionid, nota_alum, idnivel, yearid, usersession,createDate) 

     VALUES ('$idgrado', '$cursoid', '$alumnos','$idsecion','$actividad','$tipoorden','$tipoid','$nota','$idnivel','$idyear','$iddocente',NOW())"; 
   if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
  }else{
    return 0;
}
}

//GUARDAR PONDERACIONES POR CADA CURSO



function GuardarPonderadoNostadAlum($alumnos,$cursoid,$promedio,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente){
 $sql = "INSERT INTO ponderados (alumno_id, curso_id, notaacum, grado_id, ordentio, tipo_id, year_id, nivel_id, seccion,userseccion,cretedate) 
     VALUES ('$alumnos', '$cursoid', '$promedio','$idgrado','$tipoorden','$tipoid','$idyear','$idnivel','$idsecion','$iddocente',NOW())"; 
   if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
  }else{
    return 0;
}

}

function Editando_Nuevo($alumnos,$cursoid,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion){
    $sql = "select  alumno_id from ponderados where alumno_id='$alumnos' and curso_id='$cursoid' and grado_id='$idgrado' and ordentio='$tipoorden'
and  tipo_id='$tipoid' and  year_id='$idyear ' and nivel_id ='$idnivel' and seccion='$idsecion'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return count($arreglo);
    $this->conexion->cerrar();
}
}


function Actualizar_Ponderaciones($alumnos,$cursoid,$promedio,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente){

 $sql = "update ponderados set notaacum = '$promedio',userseccion='$iddocente' where alumno_id='$alumnos' and curso_id='$cursoid' and grado_id='$idgrado' and ordentio='$tipoorden'
and  tipo_id='$tipoid' and  year_id='$idyear ' and nivel_id ='$idnivel' and seccion='$idsecion'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}



  //Actualizar nota alumno
function Update_Promedio_Alumno($alumnos,$promedio){
 $sql = "update alumno set promedio = '$promedio' WHERE idalumno = '$alumnos'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
  return 1;           
  }else{
    return 0;
 }
}

//listar combo grados
function listarComboGradosViewNotas(){
    $sql = "select idgrado, gradonombre,nivel_id,nombreNivell,seccion from grado
  inner join  niveles on niveles.idniveles = grado.nivel_id;";
  $arreglo = array();
  if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
      $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
  }
}

function Listar_combo_tipos(){

   $sql = "SELECT id_periodo,tipo_periodo FROM periodo";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}

}

function Listar_combo_Cursos_grado($gradoid){
 $sql = "select curso_id,nonbrecurso from grado_curso
  inner join curso on curso.idcurso=grado_curso.curso_id
   where grado_id='$gradoid'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

}

}

//FUNCION PARA VERIFICAR SI EXISTE UN REGISTRO SIMILILAR

 function Verifica_Existencia($cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel){
     $sql = "SELECT gradoid,cursoid,seccionid,ordentipo,tipoevaluacionid,idnivel,yearid FROM notas
          where gradoid='$idgrado' and cursoid='$cursoid' and seccionid='$idsecion' and ordentipo='$tipoorden' and tipoevaluacionid='$tipoid' 
          and idnivel='$idnivel' and yearid='$idyear'";

      $arreglo = array();
     if ($consulta = $this->conexion->conexion->query($sql)) {
         while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
        }
        return count($arreglo);
         $this->conexion->cerrar();
    }
 }

//FUNCION PARA VERIFICAR LA FECHA PERMITIDA´PARA REGISTRAR NOTAS

 function VerrificarFechaEvaluacion($idyear){

$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre,fech_inicio, fech_final FROM periodo
inner join tipoevaluacion on tipoevaluacion.tipo_id =periodo.tipo_periodo where year_id='$idyear'";
       $arreglo = array();
       if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
            $arreglo[] = $consulta_VU;
        }
        return $arreglo;
        $this->conexion->cerrar();
    }


 }


function Preparar_datos_BD($cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel){
 $sql=   "delete  from notas where gradoid='$idgrado' and cursoid='$cursoid' and seccionid='$idsecion' and ordentipo='$tipoorden' and tipoevaluacionid='$tipoid'  and idnivel='$idnivel' and yearid='$idyear'";

      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }

}


//////////////////////////////////////////////////////////
/////////////DE AQUI ES REPORTE POR BIMESTRES//////////////
///////////////////////////////////////////////////////////
function Listar_Notas_Periodo($idyear){

$sql = "select ordenTipo_periodo,tipo_periodo,tipo_nombre from periodo
  inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
  where year_id='$idyear'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();

}


}


function Listar_Alumnos_Ponderados($idgrado,$idnivel,$idyear,$idsecion){

  $sql = "select  distinct alumno_id,apellidos, alumnonombre,nonbrecurso,curso_id,notaacum,ordentio from ponderados
  inner join  alumno on alumno.idalumno = ponderados.alumno_id
  inner join  curso on curso.idcurso = ponderados.curso_id
  where grado_id='$idgrado' and nivel_id='$idnivel' and year_id='$idyear' and seccion='$idsecion'";
   $arreglo = array();
   if ($consulta = $this->conexion->conexion->query($sql)) {
    while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
    }
    return $arreglo;
    $this->conexion->cerrar();
}
}


function Listar_alumnos_periodo_curso($idyear){
$tipo=$this->Listar_Notas_Periodo($idyear);
  $concat='';
  $concat.='<table class="table table-striped" id="tbl-reporNota"  style=" width: 100%">';
  $concat.='<thead>';
        $concat.='<tr>';
          $concat.='<th>N°</th>';
          $concat.='<th>Apellidos</th>';
          $concat.='<th>Nombres</th>';
          $concat.='<th>Curso</th>';
          foreach ($tipo as $val) { 
            $concat.='<th>'.$val['ordenTipo_periodo'].'°_'.$val['tipo_nombre']. '</th>';
           } 
        $concat.='</tr>';
      $concat.='</thead>';
      $concat.='<tbody>';
        $concat.='<tr>';
           $concat.='<td align="center" >1</td>';
           $concat.='<td  align="center">cerna</td>';
           $concat.='<td align="center">nimer</td>';
           $concat.='<td align="center">mate</td>';
           $concat.='<td align="center">20</td>';
           $concat.='<td align="center">20</td>';
         $concat.='</tr>';
          $concat.='</tbody>';
    $concat.='</table>';
    return $concat;
}


}
?>
