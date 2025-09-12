var editando = false;

async function total_curso() {
  try {
      const res = await fetch("../controlador/dashboard/controlador_total_curso.php");
      const json = await res.json();    
      console.log('Total de Cursos:', json.length);
      const $totalCurso = document.getElementById("totalcurso");
      $totalCurso.innerHTML = json.length;
  } catch (error) {
      console.error('Error al obtener total de cursos:', error);
  }
}

async function total_docentes (){
  const res = await fetch("../controlador/dashboard/controlador_total_docentes.php");
  const json = await res.json();    
  const $totalDocentes = document.getElementById("totaldocentes")
  $totalDocentes.innerHTML=json.length
}

async function total_alumnos (){
  const res = await fetch("../controlador/dashboard/controlador_total_alumnos.php");
  const json = await res.json();
  const $totalalumnos = document.getElementById("totalalumnos")
  $totalalumnos.innerHTML=json.length
}

async function totaltabla() {
  try {
    const res = await fetch("../controlador/dashboard/controlador_total_tabla.php");
    const data = await res.json();
    console.log(data);

    // Obtén la referencia a la tabla HTML
    const $table = $('#table tbody');

    // Limpia cualquier contenido existente en la tabla
    $table.empty();

    // Llena la tabla HTML con nombres, apellidos y tipo de docente
    for (const docente of data) {
      $table.append(`
        <tr>
          <td>${docente.nombres || ''}</td>
          <td>${docente.apellidos || ''}</td>
          <td>${docente.tipo_docente || ''}</td>
        </tr>
      `);
    }

  } catch (error) {
    console.error('Error al obtener datos de docentes:', error);
  }
}