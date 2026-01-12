<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/admision.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Admision</title>
</head>

<body>
  <?php
  require_once './components/navigation.php';
  ?>
  <div class="banner-admision d-flex justify-content-center align-items-center pb-2">
    <div class="content text-center text-dark">
      <h3 class="text-center">Admision <span class="current-admission-year"></span></h3>
      <p>Para mas informacion sobre admisiones comunicarse al <br>
        Telefono: 954016787 - Correo: colegiooriontarma@gmail.com</p>
      <span>"SOLO PARA GANADORES"</span>
    </div>
  </div>

  <!-- Script para año actual -->
  <script>
    document.querySelectorAll('.current-admission-year').forEach(function(span) {
      span.textContent = new Date().getFullYear();
    });
  </script>

  <div class="container py-2  mt-3 pt-3 mb-3" id="seccion-1">
    <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
    <h3 class=" pb-1 title__admision"><i class="fas fa-star"></i>Servicio nivel inicial</h3>
    <div class="container row d-flex justify-content-between">
      <div class="col-md-6">
        <img src="../img/galeria/inicial/educativo_inicial.jpg" alt="una imagen del ambito inicial" class="img-fluid image__admision">
      </div>
      <div class="col-md-5 ">
        <p style="text-align:justify;">En el Colegio Orion Inicial, entendemos que los primeros años de la vida de tu hijo/a son
          los más cruciales para su desarrollo. Nuestro enfoque es crear un ambiente cálido y estimulante donde los niños puedan
          crecer, aprender y explorar de manera segura. Aquí, les damos las herramientas para comenzar su viaje educativo con
          entusiasmo y confianza.
        </p>
        <h6>Que ofrecemos:</h6>
        <br>
        <b>🌟 Exploración y Descubrimiento: </b>
        <p style="text-align:justify;">Fomentamos la curiosidad innata de los niños y les proporcionamos un espacio
          donde pueden explorar y descubrir el mundo que les rodea. Cada día en Orion es una aventura llena de
          oportunidades para aprender y crecer.
        </p>
        <br>
        <b>🌟 Aprendizaje a través del Juego:</b>
        <p style="text-align:justify;">En Orion Inicial, creemos que el juego es la forma natural en que los
          niños aprenden. Por eso, hemos diseñado un currículo que integra el juego y la creatividad en cada paso del
          viaje educativo. A través del juego, los niños desarrollan habilidades cognitivas, sociales y emocionales de
          manera natural y divertida.</p>
        <a style="background: #C09F62; color: white; align-items: center;" class="button open-form-admision">Iniciar proceso de
          admision
        </a>
      </div>
    </div>
  </div>

  <div style="padding: 0px; margin: 0;" id="seccion-2" class="mt-2 pt-2">
    <div class="container py-2">
      <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
      <h3 class=" pb-2 title__admision"><i class="fas fa-book "></i>Servicio nivel primaria</h3>
      <div class="container row d-flex justify-content-between">
        <div class="col-md-5">
          <p style="text-align:justify;">En la Primaria Orion, nos enorgullece ser la continuación del viaje educativo de tus hijos.
            Aquí, construimos sobre las bases establecidas en la educación inicial y preparamos a los estudiantes para un futuro
            lleno de logros. Nuestro enfoque es equilibrar el desarrollo académico, social y emocional para que cada niño/a alcance
            su máximo potencial.
          </p>
          <h6>Que ofrecemos:</h6>
          <br>
          <b>🌟 Excelencia Académica:</b>
          <p style="text-align:justify;">Nuestro currículo es riguroso y desafiante, fomentando el pensamiento crítico, la
            creatividad y el amor por el aprendizaje. Estamos comprometidos con proporcionar a tus hijos la mejor educación posible.
          </p>
          <br>
          <b>🌟 Desarrollo Integral:</b>
          <p style="text-align:justify;">Más allá de las materias académicas, en Orion Primaria, promovemos valores
            como la responsabilidad, la empatía y el trabajo en equipo. Queremos formar ciudadanos conscientes y éticos que
            contribuyan positivamente a la sociedad.
          </p>
          <a style="background: #C09F62; color: white;" class="button open-form-admision">Iniciar proceso de admision</a>
          <br>
        </div>
        <div class="col-md-6">
          <img src="../img/galeria/primaria/primaria_estu.jpg" alt="una imagen del ambito primaria" class="img-fluid image__admision">
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-3 pb-3 mb-4" id="seccion-3">
    <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
    <h3 class=" pb-2 title__admision"><i class="fas fa-graduation-cap  icon-border "></i>Servicio nivel secundaria</h3>
    <div class="container row d-flex justify-content-between">
      <div class="col-md-6">
        <img src="../img/galeria/secundaria/DSC00766.jpg" alt="una imagen del ambito secundaria" class="img-fluid image__admision">
      </div>
      <div class="col-md-5">
        <p style="text-align:justify;">La Secundaria Orion es el lugar donde los estudiantes continúan su viaje educativo hacia
          la independencia y la preparación para el futuro. Aquí, les brindamos las habilidades, conocimientos y valores
          necesarios para enfrentar los desafíos de la vida con confianza y determinación.
        </p>
        <h6>Que ofrecemos:</h6>
        <br>
        <b>🌟 Excelencia Académica Continua:</b>
        <p style="text-align:justify;"> Nuestro currículo sigue siendo riguroso y desafiante, preparando a
          los estudiantes para sobresalir en la educación superior y en sus futuras carreras. Nuestro compromiso con la
          excelencia académica es inquebrantable.
        </p>
        <br>
        <b>🌟 Desarrollo de Liderazgo: </b>
        <p style="text-align:justify;"> Fomentamos el liderazgo y la responsabilidad, permitiendo que los
          estudiantes se conviertan en agentes de cambio en su comunidad y en el mundo. Queremos que sean líderes éticos y
          comprometidos con el bienestar de la sociedad.
        </p>
        <a class="button open-form-admision" style="background: #C09F62; color: white;">Iniciar proceso de admision</a>
      </div>
    </div>
  </div>

  <?php
  require_once './components/footer.php'
  ?>

  <script>
    const seccionOne = document.getElementById("seccion-1")
    const seccionTwo = document.getElementById("seccion-2")
    const seccionThree = document.getElementById("seccion-3")

    document.addEventListener('DOMContentLoaded', (e) => {
      const seccionClick = localStorage.getItem("ADMISION_CLICK")
      if (seccionClick === "inicial") {
        window.scrollTo(0, seccionOne.offsetTop);
      } else if (seccionClick === "primaria") {
        window.scrollTo(0, seccionTwo.offsetTop);
      } else if (seccionClick === "secundaria") {
        window.scrollTo(0, seccionThree.offsetTop);
      } else {
        window.scrollTo(0, 0);
      }
      localStorage.setItem("ADMISION_CLICK", "")
    });
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>