<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Inicio</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/solicitarinfo.css">
  <link rel="stylesheet" href="../css/botonesdina.css">  
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/modal_cronograma.css">
  
  <!-- Fuentes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
</head>

<body>
  <?php require_once './components/navigation.php'; ?>

  <!-- Contenido principal -->
  <div class="main-content">
    <!-- Carousel -->
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
      </ol>

      <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="carousel-image-container">
            <img src="../img/banner_04.png" class="d-block w-100" alt="Admisión Colegio Orion">
          </div>
          <div class="carousel-caption">
            <div class="carousel-content">
              <h1 class="admission-year">Admisión <span class="current-admission-year"></span></h1>
              <h4 class="carousel-title">Iluminando el Futuro: Matrículas Abiertas en Colegio Orion</h4>
              <p class="carousel-text">Un vistazo a las oportunidades educativas y valores que destacan en el horizonte de Colegio Orion.</p>
              <div class="carousel-buttons">
                <button class="open-form-admision btn btn-primary">Solicita tu vacante</button>
                <a href="./noticias.php" class="btn btn-outline-light">Mira nuestros comunicados</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="carousel-image-container">
            <img src="../img/banner_05.png" class="d-block w-100" alt="Experiencia Educativa">
          </div>
          <div class="carousel-caption">
            <div class="carousel-content">
              <h1 class="admission-year">Admisión <span class="current-admission-year"></span></h1>
              <h4 class="carousel-title">Construyendo un Mañana Brillante: Únete a la Experiencia Orion</h4>
              <p class="carousel-text">Detalles sobre cómo Colegio Orion se destaca en la formación integral de estudiantes y prepara el camino hacia un futuro prometedor.</p>
              <div class="carousel-buttons">
                <button class="open-form-admision btn btn-primary">Solicita tu vacante</button>
                <a href="./noticias.php" class="btn btn-outline-light">Mira nuestros comunicados</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
          <div class="carousel-image-container">
            <img src="../img/banner_carousel.jpg" class="d-block w-100" alt="Comunidad Orion">
          </div>
          <div class="carousel-caption">
            <div class="carousel-content">
              <h1 class="admission-year">Admisión <span class="current-admission-year"></span></h1>
              <h4 class="carousel-title">Descubre el Brillo de la Educación: Colegio Orion, Donde las Estrellas Nacen</h4>
              <p class="carousel-text">Explorando la calidad educativa y el ambiente enriquecedor que define a Colegio Orion.</p>
              <div class="carousel-buttons">
                <button class="open-form-admision btn btn-primary">Solicita tu vacante</button>
                <a href="./noticias.php" class="btn btn-outline-light">Mira nuestros comunicados</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Controles -->
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Script para año actual -->
    <script>
      document.querySelectorAll('.current-admission-year').forEach(function(span) {
        span.textContent = new Date().getFullYear();
      });
    </script>

    <!-- Niveles Académicos -->
    <div class="courses">
      <div class="niveles-academicos container mt-4 mb-4">
        <hr style="color: #b11616; height: 2px; border: 1px solid #b11616; opacity: 1;">
        <h3 class="courses__title"><i class="fas fa-layer-group"></i>Nuestros niveles</h3>
        <div class="row mt-3 mb-3 seccion__courses">
          <div class="card card__grades__custom">
            <div>
              <img class="nivel-img" src="../img/educacion_inicial.jpg" alt="Inicial">
              <h4 class="card-title">Inicial o Preescolar</h4>
              <p class="card-text">Nuestro enfoque es crear un ambiente cálido y estimulante donde los niños puedan crecer, aprender y explorar de manera segura.</p>
              <a class="inicial">Más Información</a>
            </div>
          </div>

          <div class="card card__grades__custom">
            <div>
              <img class="nivel-img" src="../img/primaria.jpg" alt="Primaria">
              <h4 class="card-title">Educación Primaria</h4>
              <p class="card-text">En la Primaria Orion, nos enorgullece ser la continuación del viaje educativo de tus hijos. Aquí construimos sobre las bases establecidas.</p>
              <a class="primaria">Más Información</a>
            </div>
          </div>

          <div class="card card__grades__custom">
            <div>
              <img class="nivel-img" src="../img/DSC00690.jpg" alt="Secundaria">
              <h4 class="card-title">Educación Secundaria</h4>
              <p class="card-text">La Secundaria Orion es el lugar donde los estudiantes continúan su viaje educativo hacia la independencia y la preparación para el futuro.</p>
              <a class="secundaria">Más Información</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Script para cambio de imágenes -->
      <script>
        const imageSets = [
          ["../img/educacion_inicial.jpg", "../img/educa_inicial.jpg", "../img/inicial.jpg"],
          ["../img/primaria.jpg", "../img/estu_primaria.jpg", "../img/edu_prima.jpg"],
          ["../img/DSC00690.jpg"]
        ];

        document.querySelectorAll('.nivel-img').forEach((imageElement, i) => {
          let index = 0;
          const images = imageSets[i];
          if (!images) return;

          setInterval(() => {
            imageElement.classList.add("hide");
            setTimeout(() => {
              imageElement.src = images[index];
              imageElement.classList.remove("hide");
              index = (index + 1) % images.length;
            }, 1000);
          }, 5000);
        });
      </script>

      <!-- Solicita Información -->
      <div class="container animacionMV mt-4 mb-4">
        <hr style="color: #b11616; height: 2px; border: 1px solid #b11616; opacity: 1;">
        <h3 class="courses__title" style="color: #b11616; font-weight: bold;">
          <i class="fa fa-graduation-cap"></i>Si tienes dudas solicita información
        </h3>
      </div>

      <div class="formulario-fondo">
        <div class="Solicitainformacion">
          <h3 align="center" class="h3-solicitainfo">Solicita Información</h3>
          <form class="form" action="https://formsubmit.co/colegiooriontarma@gmail.com" method="POST">
            <div class="form-group">
              <label for="nombre">Nombres:</label>
              <input type="text" id="nombre" name="nombre" placeholder="Nombres" required>
            </div>
            <div class="form-group">
              <label for="apellido">Apellidos:</label>
              <input type="text" id="apellido" name="apellido" placeholder="Apellidos" required>
            </div>
            <div class="form-group">
              <label for="email">Correo Electrónico:</label>
              <input type="email" id="email" name="email" placeholder="Correo" required>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="celular">Número Celular:</label>
                <input type="tel" id="celular" name="celular" placeholder="Número Celular +51" maxlength="9" required>
              </div>
              <div class="form-group">
                <label for="nivel">Nivel Interesado:</label>
                <select id="nivel" name="nivel" required>
                  <option value="" disabled selected>Seleccione</option>
                  <option value="inicial">Inicial</option>
                  <option value="primaria">Primaria</option>
                  <option value="secundaria">Secundaria</option>
                </select>
              </div>
            </div>
            <div class="politica_y_terminos">
              <label>
                <input type="checkbox" id="check-terminos" required> Acepto los
                <a href="#" id="link-terminos" class="link-terminos">Términos y Condiciones</a>
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn-enviar" name="enviar">Enviar</button>
            </div>
          </form>
        </div>
        <!-- Modal de Términos y Condiciones -->
        <div class="imagen-formulario">
          <img src="../img/colegiala_formulario002.png" alt="Imagen Informativa">
        </div>
        <div id="modal-terminos" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <h2>Términos y Condiciones</h2>
            </div>
            <div class="modal-text">
              <p>El COLEGIO ORION, con domicilio legal en Jiron los Maizales, Tarma - Junín; garantiza la seguridad y
                  confidencialidad en
                  el tratamiento de los datos personales, de acuerdo a la Ley No. 29733, Ley de Protección de Datos
                  Personales, y su Reglamento, aprobado por Decreto
                  Supremo No. 003-2013-JUS. En adelante toda referencia a “Usuarios”, se usará para todas aquellas
                  personas que utilicen y/o naveguen a través de nuestro
                  sitio web https://colegiosorion.edu.pe/ y que hayan suministrado sus datos personales recopilados y
                  tratados por el Colegio Orion mediante formularios
                  físicos o virtuales en ejercicio de sus actividades como empresa dedicada al rubro educativo.
                </p>
                <p><strong>I. SOBRE LA INFORMACIÓN RECOLECTADA:</strong></p>
                <p>1.1.- Toda información proporcionada al Colegio Orion es a través de su sitio web institucional
                  https://colegiosorion.edu.pe/
                  o de formularios físicos o virtuales proporcionados por el Colegio Orion para contactar con los
                  usuarios interesados en nuestros servicios, los que
                  serán tratados e incorporados en las bases datos de las que el Colegio Orion es titular y responsable.
                </p>
                <p>1.2.- Respecto de las personas naturales, solicitamos la siguiente información: (a) Información
                  general del
                  estudiante/postulante y su/sus apoderados/: nombre, documento de identidad, edad, fecha de nacimiento,
                  teléfono, dirección y correo electrónico.
                  Esta información es básicamente un primer filtro para luego comunicarnos verbalmente o mediante
                  nuestros canales internos de comunicación con el
                  usuario interesado, NO significa ningún vínculo o responsabilidad adicional, así como NO significa el
                  aseguramiento de una VACANTE en los procesos de
                  admisión que convocamos. De no proporcionar dicha información, no se le podrá brindar atención para el
                  servicio solicitado al Colegio Orion.
                </p>
                <p>1.3.- Toda información proporcionada debe ser verdadera, completa y exacta. Cada Usuario es
                  responsable por la veracidad, exactitud, vigencia y
                  autenticidad de la información suministrada.
                </p>
                <p>1.4.- El Colegio Orion no se hace responsable de la veracidad de la información que no sea de
                  elaboración propia, por lo que tampoco asume
                  responsabilidad alguna por posibles daños o perjuicios que pudieran originarse por el uso de dicha
                  información.
                </p>
                <p><strong>II. SU INFORMACIÓN SE TRATA DE MANERA SEGURA:</strong></p>
                <p>2.1.- El Colegio Orion garantiza la confidencialidad en el tratamiento de los datos de carácter
                  personal, así como haber adoptado los niveles de
                  seguridad de protección de los datos personales, instalando todos los medios y medidas técnicas,
                  organizativas y legales posibles a su alcance que
                  garanticen la seguridad y eviten la alteración, pérdida, tratamiento o acceso no autorizado a dicha
                  información.
                </p>
                <p><strong>III. SOBRE LA BASE DE DATOS Y EL PLAZO DE CONSERVACIÓN</strong></p>
                <p>3.1.- Según lo establecido en la LPDP y RLPDP, el Colegio Orion declara que la Información recopilada
                  será incorporada a las bases de datos internas
                  del Colegio Orion. A través de esta política, el Usuario otorga su consentimiento expreso para la
                  inclusión de su información en nuestras bases de
                  datos.
                </p>
                <p>3.2.- Los datos personales serán conservados durante el tiempo en que el usuario mantenga una
                  relación con el Colegio Orion y, con posterioridad
                  al término de ésta, se mantendrán por un total de cinco (5) años. Transcurrido dicho tiempo, serán
                  eliminados.
                </p>
                <p><strong>IV. SOBRE EL USO Y TRATAMIENTO DE LA INFORMACIÓN:</strong></p>
                <p>4.1.- Los datos que se proporcionan serán tratados para las siguientes finalidades, relacionadas
                  estrictamente con los servicios que los Usuarios
                  solicitan del Colegio Orion:
                </p>
                <ul>
                  <li>Absolver dudas y consultas sobre los servicios del Colegio Orion que los usuarios ingresen y
                    registren vía la página web institucional.</li>
                  <li>Atender y procesar a los nuevos usuarios que estén interesados en recibir información de las
                    vacantes disponibles de la página
                    de Admisión e iniciar dicho proceso.</li>
                </ul>
                <p>Los Usuarios manifiestan que han sido debidamente informados de todas las finalidades antes
                  mencionadas. Asimismo, los Usuarios otorgan su
                  consentimiento previo, libre, expreso, inequívoco y gratuito, para el tratamiento de su información,
                  de conformidad con las finalidades antes
                  descritas.
                </p>
            </div>
            <div class="modal-footer">
              <button id="cancel-terminos" class="btn btn-cancelar">Cancelar</button>
              <button id="accept-terminos" class="btn btn-aceptar">Aceptar</button>
            </div>
          </div>
        </div>
        <!-- Enlazar archivo JavaScript -->
        <script src="../js/solicitarinfo.js"></script>
      </div>

      <!-- Datos Institucionales -->
      <div class="datos-institucionales container mt-4 mb-4">
        <hr style="color: #b11616; height: 2px; border: 1px solid #b11616; opacity: 1;">
        <h3 class="courses__title"><i class="fas fa-database icon-border"></i>Datos del Colegio</h3>
        <div class="row py-3 mt-3">
          <div class="col-md-3 col-6">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="430">0</h3>
              <p>Estudiantes de inicial</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="400">0</h3>
              <p>Estudiantes de primaria</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="300">0</h3>
              <p>Estudiantes de secundaria</p>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="16">0</h3>
              <p>Docentes</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Script para contadores -->
      <script>
        function formatNumberWithCommas(number) {
          return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function animateValue(element, start, end, duration) {
          let startTimestamp = null;
          const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = formatNumberWithCommas(value);
            if (progress < 1) window.requestAnimationFrame(step);
          };
          window.requestAnimationFrame(step);
        }

        const observer = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const targetElement = entry.target;
              const targetValue = parseInt(targetElement.dataset.targetValue, 10);
              animateValue(targetElement, 0, targetValue, 2000);
              observer.unobserve(targetElement);
            }
          });
        }, { threshold: 0.1 });

        document.querySelectorAll(".contador").forEach((contador) => {
          observer.observe(contador);
        });
      </script>

      <!-- Noticias -->
      <div class="container mt-4 mb-4">
        <div class="row mb-3">
          <div class="title-noticias col-12">
            <hr style="color: #b11616; height: 2px; border: 2px solid #b11616; opacity: 1;">
            <h3 class="courses__title"><i class="fas fa-newspaper icon-border"></i>Últimas Noticias</h3>
          </div>
        </div>
        <div class="gird-news"></div>
      </div>
    </div>
  </div>

  <?php require_once './components/footer.php'; ?>

  <!-- Modal Cronograma de Matrícula -->
  <?php require_once './components/modal_cronograma.php'; ?>
  <script src="../js/modal_cronograma.js"></script>

  <!-- Script para noticias -->
  <script>
    async function obtenerNoticias() {
      const myForm = new FormData()
      myForm.append("modulo_noticia", "obtener")
      const URL = "../ajax/noticia_ajax.php"
      try {
        const res = await fetch(URL, { method: "POST", body: myForm })
        const json = await res.json();
        if (json.length === 0) {
          document.querySelector(".gird-news").innerHTML = `<h1 class="new__void">No hay noticias</h1>`
        } else {
          const jsonFilter = filterByImportant(json)
          paintNotices(jsonFilter)
        }
      } catch (err) {
        document.querySelector(".gird-news").innerHTML = `<h1 class="new__void">Error en el servidor</h1>`
      }
    }

    function formatearFecha(fechaString) {
      const meses = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
      const fecha = new Date(fechaString);
      const dia = fecha.getDate();
      const mes = meses[fecha.getMonth()];
      return { dia: (dia < 10 ? '0' : '') + dia, mes: mes.toUpperCase() };
    }

    function filterByImportant(noticias) {
      return noticias.sort((a, b) => {
        const comparacionImportancia = b.importante - a.importante;
        if (comparacionImportancia === 0) {
          return new Date(b.fechaCreacion) - new Date(a.fechaCreacion);
        }
        return comparacionImportancia;
      });
    }

    function paintNotices(data) {
      const $gridNotice = document.querySelector(".gird-news");
      let modifyData = data.slice(0, 4);
      
      if (modifyData.length === 0) {
        $gridNotice.innerHTML = `<h1 class="new__void">No hay noticias</h1>`;
        return;
      }

      $gridNotice.innerHTML = '';
      modifyData.forEach((notice) => {
        const fecha = formatearFecha(notice.fechaCreacion);
        $gridNotice.innerHTML += `
          <div class="new" id="notice-card-index" data-set="${notice.id}">
            <div class="new__decoration"></div>
            <img src="<?= $GLOBALS['images'] ?>${notice.portada}" alt="Noticia">
            <div class="new__circle">
              <p>${fecha.dia}</p>
              <span>${fecha.mes}</span>
            </div>
            <h2>${notice.titulo}</h2>
          </div>
        `;
      });
    }

    document.addEventListener('click', e => {
      if (e.target.closest('#notice-card-index')) {
        const id = e.target.closest('#notice-card-index').getAttribute("data-set")
        window.location.href = `./noticia.php?id=${id}`;
      }
    })

    obtenerNoticias()
  </script>

  <!-- Scripts -->
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/solicitarinfo.js"></script>
</body>
</html>