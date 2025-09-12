
<?php
session_start();
if (!empty($_SESSION['S_IDENTYTI'])) {
    require '../../modelo/modelo_notas.php';
    $MU = new Nota();

      $iddocente = $_SESSION['S_IDENTYTI'];

      date_default_timezone_set('America/Lima');
    $cursoid = htmlspecialchars($_POST['cursoid'],ENT_QUOTES,'UTF-8');
     $idyear = htmlspecialchars($_POST['idyear'],ENT_QUOTES,'UTF-8');
     $tipoorden = htmlspecialchars($_POST['tipoorden'],ENT_QUOTES,'UTF-8');
    $tipoid = htmlspecialchars($_POST['tipoid'],ENT_QUOTES,'UTF-8');
     $idnivel = htmlspecialchars($_POST['idnivel'],ENT_QUOTES,'UTF-8');
    $idgrado = htmlspecialchars($_POST['idgrado'],ENT_QUOTES,'UTF-8');
    $idsecion = htmlspecialchars($_POST['idsecion'],ENT_QUOTES,'UTF-8');
    //$idtipo = htmlspecialchars($_POST['idtipo'],ENT_QUOTES,'UTF-8');
   
     $alumnos = htmlspecialchars($_POST['idalumnos'],ENT_QUOTES,'UTF-8');
     $actividads = htmlspecialchars($_POST['idactividad'],ENT_QUOTES,'UTF-8');
     $notas = htmlspecialchars($_POST['notas'],ENT_QUOTES,'UTF-8');
     $ponderados = htmlspecialchars($_POST['ponderados'],ENT_QUOTES,'UTF-8');


     $contador=0;
     $alumnos=explode(",", $alumnos);
     $actividad = explode(",",$actividads);
     $nota = explode(",", $notas);
     $promedio = explode(",", $ponderados);

     //VERIFICAR SI YA VENCIO EL PLAZO

     $limitfec = $MU->VerrificarFechaEvaluacion($idyear);
     //RECORRE LA FECHAS PARA COMPARAR
     foreach ( $limitfec as $value) { 
     //COMPARAMOS LA ORDEN
      if ($value['ordenTipo_periodo']==$tipoorden ) {
        //COMPARENT DATE EQUALS AN INGRESENT BY EXISTNS
          $FechaActual=date('Y-m-d');
        if ($value['fech_final'] <= $FechaActual) {
          echo 500;
          return 'SEC_ERROR_UNKNOWN_ISSUER';
        }
       
      }
     }
     //FIN DE VERIFICACION


    $verific= $MU->Verifica_Existencia($cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel);

    if($verific>0){

       $resquet = $MU->Preparar_datos_BD($cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel);
     
      }
     


    for ($i=0; $i <count($alumnos) ; $i++) { 
      if ($alumnos[$i] !='') {
            //PARA HACER REPORTE DE NOTAS POR BIMESTRES.

          $consilta= $MU->Editando_Nuevo($alumnos[$i],$cursoid,$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion);

           if ($consilta>0) {
               $MU->Actualizar_Ponderaciones($alumnos[$i],$cursoid,$promedio[$i],$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente);
           }else{
            $MU->GuardarPonderadoNostadAlum($alumnos[$i],$cursoid,$promedio[$i],$idgrado,$tipoorden,$tipoid,$idyear,$idnivel,$idsecion,$iddocente);
           }
           
           //fin de ponderaciones

           for ($j=0; $j <count($actividad) ; $j++) { 
             if ($actividad[$j] !='') {
              
                $valor = empty($nota[$j]) ? 0 : $nota[$j];
                
                $consulta=$MU->Registrar_Notas_Alumno($alumnos[$i],$actividad[$j], $valor,$cursoid,$idgrado,$idsecion,$tipoorden,$tipoid,$idyear,$idnivel,$iddocente);
                $contador++;
                }

                }
                $nota=array_slice($nota,$contador);
                $contador=0;

        }

      }
     echo $consulta ;

}

 ?>