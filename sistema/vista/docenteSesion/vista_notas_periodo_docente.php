<script type="text/javascript" src="../js/docente_nota.js?rev=<?php echo time();?>"></script>


<?php

if (!empty($_GET['idgrado'])){
$idgrado = htmlspecialchars($_GET['idgrado'],ENT_QUOTES,'UTF-8');
//$idcurso = htmlspecialchars($_GET['idcurso'],ENT_QUOTES,'UTF-8');
$idsecion = htmlspecialchars($_GET['idsecion'],ENT_QUOTES,'UTF-8');
$idyear = htmlspecialchars($_GET['idyear'],ENT_QUOTES,'UTF-8');
$idnivel = htmlspecialchars($_GET['idnivel'],ENT_QUOTES,'UTF-8');
$nombreNivel = htmlspecialchars($_GET['nombreNivel'],ENT_QUOTES,'UTF-8');




include_once '../../modelo/modelo_notas.php';
  $MU  = new  Nota();


  $tiposevaluacion = $MU->Listar_Notas_Periodo($idyear);
  $alumnos = $MU->Listar_Alumnos_Ponderados($idgrado,$idnivel,$idyear,$idsecion);
 


  $stdClas=  array();
 foreach ($alumnos as $value) { 

  $stdClas[] = array('ialumno' => $value['alumno_id'],'idcurso' => $value['curso_id'],'nota' => $value['notaacum'],'tipoOrden'=>$value['ordentio']);
  
}


$notasTem = array();
function Ponderaciones_Acumulados($i,$id,$stdClas,$idcurso,$orden,$indice){

  foreach ($stdClas as  $value) {
    if ($value['tipoOrden']==$orden) {
     if ($value['tipoOrden']==$i) {
      if ($value['ialumno']==$id) {
       if ($value['idcurso']==$idcurso) {
        return $value['nota'] ?? '0';
      }
    }
  }
}  
}
}
}

?>


<div class="col-md-12">
  <div class="box box-warning ">
    <div class="box-header with-border" id="Titulo_Center">
      <h5 class="box-title"><strong>Notas Por Periodo - <?php echo date('Y');?></strong></h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <style type="text/css">
      #btn_bucar_data {
        border: none;
        border-radius: 5px;
        color: white;
        background-color: #3894c9;
      }
      </style>
      <div class="row">
        <div class="col-xs-12">
          <div class="col-md-4">
            <label for="">Grado</label>
            <select class="js-example-basic-single" name="state" id="rep_cbm_grado" style="width:100%; "
              onchange="ShowSelectedCursos();">

            </select><br><br>
          </div>
          <div class="col-md-4">
            <label for="">Nivel</label>
            <input type="text" name="" id="txt_nivelId" hidden>
            <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled
              value=" <?php echo !isset($nombreNivel)?? '' ; ?> ">
          </div>
          <div class="col-md-4">
            <label for="">Seccion</label>
            <div class="alin_global">
              <input type="text" name="" class="form-control" id="text_seccion" disabled
                value=" <?php echo  !isset($idsecion)?? '' ; ?> ">&nbsp;
              <button onclick="Consultar_Parametros_Docente();" class="btn-sm" id="btn_bucar_data"> <em
                  class="fa fa-search"></em> </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<?php if(!empty($alumnos)) {?>

<div class="col-md-12">
  <div class="box box-warning ">
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-xs-6 clasbtn_exportar">
          <div class="input-group" id="btn-place"></div>
        </div>
        <div class="col-xs-6 pull-right">
          <input type="text" class="global_filter form-control pull-right" id="global_filter" autocomplete="false"
            style="border-radius: 5px;">

        </div>
      </div>
      <br>
      <table class="table table-striped" id="tbl-reporNota" style=" width: 100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Curso</th>
            <?php foreach ($tiposevaluacion as $val) { ?>
            <th><?= $val['ordenTipo_periodo'].'°_'.$val['tipo_nombre'] ?></th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php
       $count = 1; $indice=0;
       foreach ($alumnos as $alun) {
        ?>
          <tr>
            <td align='center'><?= $count ?></td>
            <td align='center'><?= $alun['apellidos'] ?></td>
            <td align='center'><?= $alun['alumnonombre'] ?></td>
            <td align='center'><?= $alun['nonbrecurso'] ?></td>


            <?php  for ($i=1; $i <=count($tiposevaluacion) ; $i++)  {

             $nota=Ponderaciones_Acumulados($i,$alun['alumno_id'],$stdClas,$alun['curso_id'],$alun['ordentio'],$indice); ?>

            <?php if($nota> 10.5) { ?>
            <td align='center'><label class=' form-control' id='id_aprob'><?php echo $nota? $nota:'0';  ?> </label>
            </td>

            <?php  }else{ ?>
            <td align='center'><label class=' form-control' id='id_desap'><?php echo $nota? $nota:'0';  ?></label> </td>

            <?php  }} ?>

          </tr>
          <?php
      $count++;$indice++;  }
      ?>

        </tbody>
      </table>

    </div>
  </div>
</div>

<?php }?>


<script type="text/javascript">
$(document).ready(function() {
  $("#refres_add").hide();
  $('.js-example-basic-single').select2();
  listar_Combo_Grados_report_docente();

});
$(function() {
  var table = $("#tbl-reporNota").DataTable({
    "ordering": true,
    "bLengthChange": false,
    "searching": {
      "regex": false
    },
    "responsive": true,
    dom: 'Bfrtip',
    buttons: [

      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ]
  });
  document.getElementById("tbl-reporNota_filter").style.display = "none";
  $('input.global_filter').on('keyup click', function() {

    filterGlobal();
  });


  $('#btn-place').html(table.buttons().container());

})

function filterGlobal() {
  $('#tbl-reporNota').DataTable().search($('#global_filter').val(), ).draw();
}
</script>