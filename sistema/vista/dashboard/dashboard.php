  <script type="text/javascript" src="../js/dashboard.js?rev=<?php echo time(); ?>"></script>
  <div class="col-md-12">
    <div class="box box-warning ">
      <div class="box-body">
        <div id="componenteGrados">
          <div class="col-md-3">
            <div class="info-box bg-green" style="border-radius: 6px"><span class="info-box-icon"
                style="width: 70px;border-radius: 6px">
                <em class="fa fa-users ">
                  
                </em>
                
                </span>
              <div class="info-box-content">
                <div class="" style="margin-top: 10px">
                  <h5 class="">
                    <strong>Nº Total</strong>
                  </h5>
                  <h5 class="">de docentes</h5>
                </div>
                <div> <a class="small-box-footer" style="color: #f7f5f3;cursor: pointer;font-size: 25px">
                    <strong id="totaldocentes"></strong> </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-purple" style="border-radius: 6px"><span class="info-box-icon"
                style="width: 70px;border-radius: 6px">
                <em class="fa fa-user-plus ">

                </em></span>
              <div class="info-box-content">
                <div class="" style="margin-top: 10px">
                  <h5 class="">
                    <strong>Nº Total</strong>
                  </h5>
                  <h5 class="">de alumnos</h5>
                </div>
                <div> <a class="small-box-footer" style="color: #f7f5f3;cursor: pointer;font-size: 25px"><strong
                      id="totalalumnos"></strong> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="info-box bg-orange" style="border-radius: 6px"><span class="info-box-icon"
                style="width: 70px;border-radius: 6px">
                <em class="fa fa-pencil ">
                </em></span>
              <div class="info-box-content">
                <div class="" style="margin-top: 10px">
                  <h5 class="">
                    <strong>Nº Total</strong>
                  </h5>
                  <h5 class="">de cursos</h5>
                </div>
                <div> <a class="small-box-footer" onclick="Summary_exit_entry()"
                    style="color: #f7f5f3;cursor: pointer;font-size: 25px"><strong id="totalcurso"></strong>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-navy" style="border-radius: 6px"><span class="info-box-icon"
                style="width: 70px;border-radius: 6px">
                <em class="fa fa-bars">

                </em></span>
              <div class="info-box-content">
                <div class="" style="margin-top: 10px">
                  <h5 class="">
                    <strong>Cierre </strong>
                  </h5>
                  <h5 class="">de matriculas</h5>
                </div>
                <div> <a class="small-box-footer" style="color: #f39c12;cursor: pointer;font-size: 25px"><strong
                      id="pettycash_summary">12-03-2024</strong> </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!---------------------------------------------- graficos 1 ---------------------------------------->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(curso_graficos);

  async function curso_graficos() {
    try {
      const res = await fetch("../controlador/dashboard/controlador_total_graficos.php");
      const json = await res.json();
      drawCharts(json, 'donutchart', 'Nuestras cursos');
    } catch (error) {
      console.error('Error al obtener nombres de cursos:', error);
    }
  }

  function drawCharts(nonbrecursos, chartId, chartTitle) {
    var data = google.visualization.arrayToDataTable([
      ['Curso', 'Algo'],
      ...nonbrecursos.map(curso => [curso, 1])
    ]);

    var options = {
      title: chartTitle,
      pieHole: 0.4,
      pieSliceText: 'none'
    };

    var chart = new google.visualization.PieChart(document.getElementById(chartId));
    chart.draw(data, options);
  }
</script>

<!---------------------------------------------- graficos 2 ---------------------------------------->
<script type="text/javascript">
  google.charts.setOnLoadCallback(curso_graficos_2);

  async function curso_graficos_2() {
    try {
      const res = await fetch("../controlador/dashboard/controlador_total_categoria.php");
      const json = await res.json();
      drawCharts(json, 'piechart', 'Nuestras categorias');
    } catch (error) {
      console.error('Error al obtener categorías:', error);
    }
  }
</script>
<!---------------------------------------------- graficos 3 ---------------------------------------->
<body>
  <div id="charts-container" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
    <div id="donutchart" style="margin: 15px; width: 47%; height: 450px;"></div>
    <div id="piechart" style="margin: 15px; width: 47%; height: 450px;"></div>
    <div class="container" style="flex-grow: 1; margin: 8px 0; width: 100%;">
    <h2 style="background-color: #333; color: white; padding: 10px; text-align: center;">Lista de nuestros docentes</h2>

      <table id="table" class="table table-striped table-bordered" style="width: 100%;">
        <thead class="thead-dark" style="background-color: #333; color: white;">
          <tr>
            <th style="background-color: #555; color: white;">Nombre</th>
            <th style="background-color: #555; color: white;">Apellidos</th>
            <th style="background-color: #555; color: white;">Tipo docente</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <!-- Aquí se llenarán dinámicamente las filas con datos de los docentes -->
        </tbody>
      </table>
    </div>
  </div>
  <script>
    total_docentes();
    total_alumnos();
    total_curso();
    
    $(document).ready(async function () {
      await totaltabla(); // Espera a que se complete la función antes de continuar
    });
   
   
  
  </script>
</body>
