<?php
class Alumno
{
  private $conexion;
  function __construct()
  {
    require_once 'modelo_conexion.php';
    $this->conexion = new conexion();
    $this->conexion->conectar();
  }

  /*
  function Extraer_contracena($usu_id){
       $sql = "SELECT usu_id,usu_contrasena FROM usuarios WHERE usu_id='$usu_id'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
        while ($consulta_VU = mysqli_fetch_array($consulta)) {
                  
                $arreglo[] = $consulta_VU;
                   
        }
        return $arreglo;
        $this->conexion->cerrar();
   }
}
*/

  function listar_ubigeo()
  {
    $sql = "select * from ubigeo";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo["data"][] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }
  }


  function Verificar_Existencia($apellp, $nombre, $dni, $codi)
  {

    $sql = "SELECT apellidos, alumnonombre, dni,codigo FROM alumno WHERE apellidos='$apellp' and alumnonombre='$nombre' and dni='$dni' and codigo='$codi'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_array($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return count($arreglo);
      $this->conexion->cerrar();
    }

  }

  function listar_alumnos()
  {
    $sql = " select idalumno,apellidos, alumnonombre, dni, telefono, codigo, sexo, stadoalumno from alumno where bajaAlumn='1'";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo["data"][] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();
    }
  }


  function Registrar_New_Alumno($idalumno, $apellp, $nombre, $fechaN, $dni, $telf, $codi, $sexo, $direccion, $tp_docu, $ubigeo, $image)
  {
    $sql = "insert into alumno (apellidos, alumnonombre, dni, telefono, codigo, sexo, fnacimiento, stadoalumno, fechaRegisto, fechaUpdate, direccion, rolalumno, alumno_foto, fk_docu, fk_ubigeo)
  values ('$apellp','$nombre','$dni','$telf','$codi','$sexo','$fechaN','ACTIVO',NOW(),NOW(),'$direccion','3','$image', '$tp_docu', '$ubigeo')";
    if ($consulta = $this->conexion->conexion->query($sql)) {

      $idalum = mysqli_insert_id($this->conexion->conexion);
      return $idalum;
    } else {
      return 0;
    }

  }


  function Registrar_New_Apoderados($id_Alumno, $nom_pade, $apell_pade, $dni_pade, $nom_madre, $apell_madre, $dni_madre, $nom_cole, $nom_direc, $cole_codig, $tp_docu_madre, $tp_docu_padre, $ubigeo_madre, $ubigeo_padre)
  {

    $sql = "insert into apoderados (paderNombre, PadreApellidos, padreDni, madreNombres, madreApellidos, madreDni, cole_procedente, coleUbicacion, coleCodigo, dateCreat, dateUpdate, id_Alumn, fk_docu, fk_docu_padre, fk_ubigeo_padre, fk_ubigeo )
  values ('$nom_pade','$apell_pade','$dni_pade','$nom_madre','$apell_madre','$dni_madre','$nom_cole','$nom_direc','$cole_codig',NOW(),NOW(),'$id_Alumno','$tp_docu_madre','$tp_docu_padre', '$ubigeo_padre', '$ubigeo_madre')";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }

  }

  function Extraer_Datos_Alumno($idalumno)
  {
    $sql = "select idalumno, apellidos, alumnonombre, dni, telefono, codigo, sexo, fnacimiento, direccion,
      paderNombre, PadreApellidos, padreDni, madreNombres, madreApellidos, madreDni, cole_procedente, coleUbicacion, coleCodigo from alumno inner join  apoderados on apoderados.id_Alumn  = alumno.idalumno
        where idalumno='$idalumno';";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

  function Dar_DeBaja_Alumnos($idalumno)
  {
    $sql = "UPDATE alumno SET bajaAlumn ='0'  where idalumno ='$idalumno'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }

    /*  $sql=   "DELETE FROM alumno WHERE idalumno = '$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      }else{
        return 0;
      }*/

  }

  function Actualizar_New_Alumno($idalumno, $apellp, $nombre, $fechaN, $dni, $telf, $codi, $sexo, $direccion, $tp_docu, $ubigeo, $image)
  {

    if ($image == "") {
      $sql = "UPDATE alumno SET apellidos='$apellp', alumnonombre='$nombre', dni='$dni', telefono='$telf', codigo='$codi', sexo='$sexo', fnacimiento='$fechaN', fechaUpdate=NOW(), direccion='$direccion', fk_docu='$tp_docu', fk_ubigeo='$ubigeo'  where idalumno ='$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      } else {
        return 0;
      }
    } else {
      $sql = "UPDATE alumno SET apellidos='$apellp', alumnonombre='$nombre', dni='$dni', telefono='$telf', codigo='$codi', sexo='$sexo', fnacimiento='$fechaN', fechaUpdate=NOW(), direccion='$direccion', fk_docu='$tp_docu', fk_ubigeo='$ubigeo', alumno_foto='$image'   where idalumno ='$idalumno'";
      if ($consulta = $this->conexion->conexion->query($sql)) {
        return 1;
      } else {
        return 0;
      }
    }
  }

  function Actualizar_New_Apoderados($idalumno, $nom_pade, $apell_pade, $dni_pade, $nom_madre, $apell_madre, $dni_madre, $nom_cole, $nom_direc, $cole_codig, $tp_docu_madre, $tp_docu_padre, $ubigeo_madre, $ubigeo_padre)
  {

    $sql = "UPDATE apoderados SET  paderNombre='$nom_pade', PadreApellidos='$apell_pade', padreDni='$dni_pade', madreNombres='$nom_madre', madreApellidos='$apell_madre', madreDni='$dni_madre', cole_procedente='$nom_cole', coleUbicacion='$nom_direc', coleCodigo='$cole_codig',  dateUpdate=NOW(), fk_docu='$tp_docu_madre', fk_docu_padre='$tp_docu_padre', fk_ubigeo='$ubigeo_madre', fk_ubigeo_padre='$ubigeo_padre'   where id_Alumn ='$idalumno'";
    if ($consulta = $this->conexion->conexion->query($sql)) {
      return 1;
    } else {
      return 0;
    }

  }

  ////////////////////////////////////////
///SECCION NETAMENTE ALUMNO//////////////
/////////////////////////////////////////

  function Listar_Periodos_Evaluacion_year($yearid)
  {
    $sql = "select tipo_periodo,ordenTipo_periodo,tipo_nombre FROM periodo
 inner join  tipoevaluacion on tipoevaluacion.tipo_id = periodo.tipo_periodo
where year_id='$yearid' ";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

  function Listar_Notas_Alumno_Tipo($yearid, $idorden, $alumnoid, $idcurso)
  {
    $sql = "select cargaacadId,notas.cursoid,actividades,puntajes,nota_alum from notas
   inner join  activ_curso on activ_curso.actcur_id = notas.cargaacadId
  where notas.cursoid='$idcurso' and notas.ordentipo='$idorden'  and notas.alumnoid='$alumnoid' and notas.yearid='$yearid' ";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

  function Grado_Alumno_Matriculado($yearid, $alumnoid)
  {
    $sql = " select Id_grado from matricula where Id_alumno='$alumnoid' and year_id='$yearid'";

    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }


  }

  function Listar_cursos_Grado($yearid, $idgrado)
  {
    $sql = "select idcurso, nonbrecurso from grado_curso
            inner join  curso on curso.idcurso = grado_curso.curso_id
          where grado_id='$idgrado' and yearEscolar='$yearid' ";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

  function Listar_Ponderacione_Acumulados($alumnoid, $idorden, $yearid)
  {
    $sql = "SELECT curso_id,notaacum FROM ponderados where alumno_id='$alumnoid' and year_id='$yearid' and ordentio='$idorden' ";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

  function Aulas_Alumno_Clases($yearid, $idgrado)
  {
    $sql = "select gradonombre,nombreNivell,nombreaula, piso,seccion FROM  grado
        inner join  niveles on niveles.idniveles = grado.nivel_id
        inner join  aula on aula.idaula = grado.aula_id
        where idgrado='$idgrado'";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }

  }


  function Listar_Cursos_Docentes($yearid, $idgrado)
  {
    $sql = "select nombres,apellidos,nonbrecurso,yearScolar FROM docente_curso
  inner join  docentes on docentes.id_docente = docente_curso.idDocente
    inner join  curso on curso.idcurso = docente_curso.idCursos
    inner join  yearscolar on yearscolar.id_year = docente_curso.idyear
where idGrado='$idgrado' and idyear='$yearid' ";
    $arreglo = array();
    if ($consulta = $this->conexion->conexion->query($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo[] = $consulta_VU;
      }
      return $arreglo;
      $this->conexion->cerrar();

    }
  }

}
?>