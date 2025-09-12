<style>
  .cut_txt {
    height: 320px;
    overflow: hidden;
  }

  .title {
    font-weight: 800;
  }

  .cut_img {
    object-fit: cover;
  }

  .pick_img {
    max-width: 250px;
    height: 250px;
    width: 100%;
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/docentes.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
  <title>Colegio Orion - Personal</title>
</head>

<body>
  <?php
  require_once './components/navigation.php';
  ?>
  <div class="banner-personal d-flex justify-content-center align-items-center mb-4">
    <div class="dark-container content text-center text-white">
      <h3 class="text-center">Educación De Calidad</h3>
      <hr>
      <h1 class="text-center m-5 title" style="font-weight: bold;">Nuestros profesores</h1>
    </div>
  </div>
  <div class="container-fluid pt-2">
    <div class="container">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2" style="font-weight:bold;">NUESTROS PROFESORES </span>
        </p>
        <h1 class="title">Conoce a nuestros profesores</h1>
      </div>
      <div class="row" id="docentes">
        <div class="loader__box loader__initial" id="loader-update-text">
          <?php
          require "./components/loader.php"
            ?>
          <h4>Cargando...</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid py-2 mt-3 container__personal">
    <div class="container p-0">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2" style="font-weight:bold;">Testimonios</span>
        </p>
        <h1 class="title mb-3">¡Que dicen los padres!</h1>
      </div>
      <div class="d-flex row owl-carousel testimonial-carousel">
        <div class="col-lg-3 testimonial-item px-3">
          <div class="bg-light shadow-sm rounded mb-4 p-4 cut_txt" style="text-align:justify;">

            Increíble dedicación de los docentes en la educación de nuestros hijos. Su compromiso y pasión por enseñar
            se reflejan en el progreso académico y el amor por el aprendizaje. ¡Gracias por marcar la diferencia en la
            vida de nuestros niños!
          </div>
          <div class="d-flex align-items-center">
            <img class="rounded-circle cut_img"
              src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1.2rem"
              style="width: 70px; height: 70px" alt="Image" />
            <div class="pl-3">
              <h5>Javier Pérez</h5>
              <i>Abogado</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 testimonial-item px-3">
          <div class="bg-light shadow-sm rounded mb-4 p-4 cut_txt" style="text-align:justify;">
            Los docentes son más que maestros; son guías comprensivos que inspiran el amor por el conocimiento. Su
            paciencia y habilidad para adaptarse a las necesidades individuales de cada estudiante son notables. Estamos
            agradecidos por su impacto positivo en la educación de nuestros hijos.
          </div>
          <div class="d-flex align-items-center">
            <img class="rounded-circle cut_img"
              src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              style="width: 70px; height: 70px" alt="Image" />
            <div class="pl-3">
              <h5>Luis García</h5>
              <i>Médica</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 testimonial-item px-3">
          <div class="bg-light shadow-sm rounded mb-4 p-4 cut_txt" style="text-align:justify;">

            La calidad excepcional de la enseñanza que nuestros hijos reciben es gracias a docentes excepcionales. Su
            enfoque innovador y su compromiso con el éxito de cada estudiante han creado un entorno de aprendizaje
            enriquecedor. ¡Gracias por su dedicación y pasión!
          </div>
          <div class="d-flex align-items-center">
            <img class="rounded-circle cut_img"
              src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              style="width: 70px; height: 70px" alt="Image" />
            <div class="pl-3">
              <h5>María Sánchez</h5>
              <i>Ingeniero</i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 testimonial-item px-3">
          <div class="bg-light shadow-sm rounded mb-4 p-4 cut_txt" style="text-align:justify;">

            No podemos estar más felices con los docentes de esta escuela. Su empeño en cultivar la curiosidad, el
            respeto y la autoestima en nuestros hijos va más allá de las expectativas. Estamos agradecidos por el
            impacto positivo que han tenido en el desarrollo académico y personal de nuestros pequeños.
          </div>
          <div class="d-flex align-items-center">
            <img class="rounded-circle cut_img"
              src="https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              style="width: 70px; height: 70px" alt="Image" />
            <div class="pl-3">
              <h5>Ana Rodríguez</h5>
              <i>Arquitecta</i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once './components/footer.php'
  ?>
  <script>
    const $docentes = document.getElementById("docentes")
    async function obtenerDocentes()
    {
      const URL = "../ajax/personal_ajax.php"
      try {
        const res = await fetch(URL)
        let json = await res.json()
        $docentes.innerHTML = ""
        for (let docente of json) {
          $docentes.innerHTML += `
          <div class="col-md-6 col-lg-3 text-center team mb-5">
          <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
            <img class="pick_img cut_img" src="<?= $GLOBALS['images_user'] ?>${docente.docente_foto}" alt="image" />
            <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
              <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i
                  class="fab fa-twitter"></i></a>
              <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i
                  class="fab fa-facebook-f"></i></a>
            </div>
          </div>
          <h4>${docente.apellidos} ${docente.nombres}</h4>
          <i>${docente.tipo_docente}</i>
        </div>
          
          `
        }
      } catch (err) {
        console.log(err)
      }
    }
    document.addEventListener("DOMContentLoaded", () =>
    {
      obtenerDocentes()
    })
  </script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>


</body>

</html>