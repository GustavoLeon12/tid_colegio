
<?php
    class Grado{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

        function listar_combo_grados(){
         $sql = "SELECT idgrado, gradonombre FROM grado";
          $arreglo = array();
           if ($consulta = $this->conexion->conexion->query($sql)) {
           while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
           }
          return $arreglo;
           $this->conexion->cerrar();
      }
}

//VERIFICAR SI YA EXSISTE EL GRADO CON ESOSO PARAMETROS
function Verificacion_Grado_existe($nombre, $turno,$nivel, $seccion,$aula,$yearid){
  $sql  = "select gradonombre, turno_id,nivel_id, seccion,aula_id,year_id from grado
           where gradonombre='$nombre'and turno_id='$turno'and nivel_id='$nivel'and  seccion='$seccion'and aula_id='$aula' and year_id='$yearid'";     
            $arreglo = array();
      if ($consulta = $this->conexion->conexion->query($sql)) {
           while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                   $arreglo['data'][]=$consulta_VU;
                }
           return count($arreglo);
           $this->conexion->cerrar();

          }
    }


//REGISTRAR GRADOS
function Registrar_Grado($idGrado,$nombre, $turno,$nivel, $seccion,$aula,$vacantes,$yearid){
 $sql = "insert into grado(gradonombre, aula_id, turno_id, nivel_id, vacantes, seccion, fechaRegistro, fechaActualizacion, gradostatus,year_id) values ( '$nombre', '$aula','$turno','$nivel','$vacantes','$seccion',NOW(),NOW(),'ACTIVO','$yearid')";
     
            if ($consulta = $this->conexion->conexion->query($sql)) {
                $this->cambiarestadoAula($aula);
             return 1;  
               }else{
                return 0;
           }
    }
//CAMBIAR ESTADO DE AULA CUANDO SE ASIGNA A UN GRADO
function cambiarestadoAula($aula){
     $sql = "update aula set status = 'OCUPADO' where idaula = '$aula'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}

function Update_Grado($idGrado,$nombre, $turno,$nivel, $seccion,$aula,$vacantes){
    $sql = "update grado set gradonombre = '$nombre',aula_id='$aula',turno_id='$turno',nivel_id='$nivel',vacantes='$vacantes',seccion='$seccion', fechaActualizacion=NOW()  where idgrado = '$idGrado'";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
                return 0;
            }
}

function listar_Config_gradosAll(){

  $sql = "select idgrado, gradonombre,nombreNivell,seccion from grado  inner join  niveles on niveles.idniveles = grado.nivel_id";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
}


   function listar_grados(){ 
          $sql = "select idgrado, gradonombre, nivel_id,nombreNivell,seccion,aula_id,nombreaula,grado.turno_id,turno_nombre,vacantes from grado
                      inner join  aula on aula.idaula = grado.aula_id
                      inner join  turnos on turnos.turno_id = grado.turno_id
                      inner join  niveles on niveles.idniveles = grado.nivel_id";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }


function Eliminar_Grado($idgrado){
  $sql=   "DELETE FROM grado WHERE idgrado = '$idgrado'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }
}


function Registro_Curso_Grado($idgrado,$arreglo,$yearid,$idseccion){
 $sql = "insert into grado_curso(grado_id, curso_id, yearEscolar,Idseccion, dateRegistro, dateUpdate)
  values ('$idgrado','$arreglo','$yearid','$idseccion' ,NOW(),NOW())";
     
            if ($consulta = $this->conexion->conexion->query($sql)) {
             return 1;
                
               }else{
                return 0;
              }
}


function VerificarSiCursoYaEstaAgregadoParaElGrado($idgrado,$arreglo,$yearid){
  $sql = "select grado_id, curso_id, yearEscolar from grado_curso where grado_id='$idgrado'  and curso_id='$arreglo' and  yearEscolar='$yearid' ";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                    $arreglo[]=$consulta_VU;

                }
                return count($arreglo);
                $this->conexion->cerrar();
            }

}



function Ver_Grado_Curso($idgrado,$yearid){
   $sql  = "select idcurso, nonbrecurso from grado_curso
            inner join  curso on curso.idcurso = grado_curso.curso_id
          where grado_id='$idgrado' and yearEscolar='$yearid' ";     
            $arreglo = array();
                if ($consulta = $this->conexion->conexion->query($sql)) {
                 while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                         $arreglo[]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();

               }
       }

function Quitar_curso($idcurso,$grado_id ){//eliminar solo si estado de curso esta PENDIENTE
 $sql=   "DELETE FROM grado_curso  WHERE grado_id ='$grado_id ' and curso_id = '$idcurso'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
       $this->Quitrar_Cursos_Del_Docente ($idcurso,$grado_id );

        return 1;
        
      }else{
        return 0;
      }

}

//QUITAR CURSOS PERTENECIENTES AL GRADOS DEL DOCENTES

function Quitrar_Cursos_Del_Docente ($idcurso,$grado_id ){
  $sql=   " DELETE FROM docente_curso WHERE idCursos = '$idcurso' and idGrado='$grado_id'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
    return 1;

  }else{
    return 0;
  }

}

/*
function Cambiar_estado_curso($arreglo){

 $sql = "UPDATE curso SET statuscurso = 'ASIGNADO' WHERE idcurso = '$arreglo'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
        
      }else{
        return 0;
      }

}*/
/*
function Recontruit_stado_curso($idcurso){

 $sql = "UPDATE curso SET statuscurso = 'LIBRE' WHERE idcurso = '$idcurso'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1; 
      }else{
        return 0;
      }

}*/





    }
?>


