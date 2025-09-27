<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/solicitarinfo.css">
  <link rel="stylesheet" href="../css/botonesdina.css">
  <!--Animacones libreriasc -->
  <title>Colegio Orion - Inicio</title>
</head>

<body>
  <?php
  require_once './components/navigation.php';
  ?>

  <!-- Contenido principal -->
  <div class="main-content">
    <!-- Contenido de tu página -->
    <div id="myCarousel" class="carousel slide pb-3" data-ride="carousel" data-interval="150" data-bs-ride="carousel">
      <!-- Indicadores -->
      <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
        <!-- Agrega más elementos <li> para más imágenes -->
      </ol>
      <!-- Imágenes del carrusel -->
      <div class="carousel-inner carousel__custom">
        <div class="carousel-item active">
          <div class="carousel-overlay d-flex">
            <div class="carousel-content">
              <h1 class="admission-year" style="text-align:center;">Admision <span
                  class="current-admission-year"></span></h1>
              <h4 class="carousel__content__title" style="text-align:justify;">Iluminando el Futuro: Matrículas Abiertas
                en Colegio Orion</h4>
              <p class="carousel__content__text" style="text-align:justify;">Un vistazo a las oportunidades educativas y
                valores que destacan en el horizonte de Colegio Orion.</p>
              <span class="carousel__buttons">
                <button class="open-form-admision">Solicita tu vacante</button>
                <a href="./noticias.php">Mira nuestros comunicados</a>
              </span>
            </div>
          </div>
          <img src="../img/DSC00791.jpg" class="d-block w-100" alt="Imagen 1">
        </div>
        <div class="carousel-item">
          <div class="carousel-overlay d-flex">
            <div class="carousel-content">
              <h1 class="admission-year" style="text-align:center;">Admision <span
                  class="current-admission-year"></span></h1>
              <h4 class="carousel__content__title" style="text-align:justify;">Construyendo un Mañana Brillante: Únete a
                la Experiencia Orion</h4>
              <p class="carousel__content__text" style="text-align:justify;">Detalles sobre cómo Colegio Orion se
                destaca en la
                formación integral de estudiantes y prepara el camino hacia un futuro prometedor.</p>
              <span class="carousel__buttons">
                <button class="open-form-admision">Solicita tu vacante</button>
                <a href="./noticias.php">Mira nuestros comunicados</a>
              </span>
            </div>
          </div>
          <img src="../img/carrusel1.png" class="d-block w-100" alt="Imagen 2">
        </div>
        <div class="carousel-item">
          <div class="carousel-overlay">
            <div class="carousel-content">
              <h1 class="admission-year" style="text-align:center;">Admision <span
                  class="current-admission-year"></span></h1>
              <h4 class="carousel__content__title" style="text-align:justify;">Descubre el Brillo de la Educación:
                Colegio Orion, Donde las Estrellas Nacen</h4>
              <p class="carousel__content__text" style="text-align:justify">Explorando la calidad educativa y el
                ambiente enriquecedor
                que define a Colegio Orion.</p>
              <span class="carousel__buttons">
                <button class="open-form-admision">Solicita tu vacante</button>
                <a href="./noticias.php">Mira nuestros comunicados</a>
              </span>
            </div>
          </div>
          <img src="../img/DSC00644.jpg" class="d-block w-100" alt="Imagen 3">
        </div>
        <!-- Agrega más elementos <div class="carousel-item"> para más imágenes -->
      </div>

      <!-- Flechas de control -->
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <script>
      // Obtiene el año actual
      var currentYear = new Date().getFullYear();

      // Selecciona todos los spans con la clase correspondiente y les asigna el año
      document.querySelectorAll('.current-admission-year').forEach(function(span) {
        span.textContent = currentYear;
      });
    </script>

    <script>
      document.getElementById('contact-form').addEventListener('submit', function(event) {
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var tipoDocumento = document.getElementById('tipoDocumento').value;
        var numDoc = document.getElementById('numDoc').value;
        var telefono = document.getElementById('telefono').value;
        var terminosCheckbox = document.getElementById('terminosCheckbox').checked;

        if (nombre === '' || apellido === '' || tipoDocumento === '' || numDoc === '' || telefono === '' || !
          terminosCheckbox) {
          event.preventDefault();
          alert('Por favor, complete todos los campos y acepte los términos y condiciones.');
        } else if (telefono.length !== 9 || telefono.charAt(0) !== '9') {
          event.preventDefault();
          alert('El número de teléfono debe tener 9 dígitos y comenzar con "9".');
        }
      });
    </script>

    <div class="courses ">
      <!-- Contenedor del formulario encima del carrusel -->
      <div class="niveles-academicos container pb-2 mt-0 mb-2">
        <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
        <h3 class=" courses__title"><i class="fas fa-layer-group"></i>Nuestros niveles </h3>
        <div class=" row mt-2 mb-2 pb-2 seccion__courses" style="margin-left: 50px;">
          <div class="card card__grades__custom">
            <div href="../views/admision.php" style="color: black;">
              <div class="">
                <img id="image1" src="../img/DSC00530.jpg" alt="" width="100%">
                <h4 class="card-title">Inicial o Preescolar</h4>
                <p class="card-text" style="text-align:justify;">Nuestro enfoque es crear un ambiente cálido y
                  estimulante donde los niños puedan
                  crecer, aprender y explorar de manera segura. Aquí, les damos las herramientas para comenzar su
                  viaje educativo con entusiasmo y confianza.</p>
                <a class="inicial">Más Información</a>
              </div>
            </div>
          </div>

          <div class="card card__grades__custom">
            <div style="color: black;">
              <div class="">
                <img id="image1" src="../img/DSC00644.jpg" alt="" width="100%">
                <h4 class="card-title">Educación Primaria</h4>
                <p class="card-text" style="text-align:justify;">En la Primaria Orion, nos enorgullece ser la
                  continuación del viaje educativo de
                  tus hijos. Aquí, construimos sobre las bases establecidas en la educación inicial y preparamos a los
                  estudiantes para un futuro lleno de logros.</p>
                <a class="primaria">Más Información</a>
              </div>
            </div>
          </div>

          <div class="card card__grades__custom">
            <div href="../views/admision.php" style="color: black;">
              <div class="">
                <img id="image1" src="../img/DSC00690.jpg" alt="" width="100%">
                <h4 class="card-title">Educación Secundaria</h4>
                <p class="card-text" style="text-align:justify;">La Secundaria Orion es el lugar donde los estudiantes
                  continúan su viaje educativo
                  hacia la independencia y la preparación para el futuro. Aquí, les brindamos las habilidades,
                  conocimientos y valores necesarios para enfrentar los desafíos de la vida.</p>
                <a class="secundaria">Más Información</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        const images = [
          "../img/DSC00530.jpg",
          "../img/DSC00549.jpg",

          // Agrega más rutas de imágenes aquí si es necesario
        ];

        let currentImageIndex = 0;
        const imageElement = document.getElementById("image1"); // Cambia el ID según corresponda

        function changeImage() {
          imageElement.classList.add("hide"); // Agrega la clase "hide" para ocultar la imagen con transición
          setTimeout(() => {
            imageElement.src = images[currentImageIndex];
            imageElement.classList.remove("hide"); // Elimina la clase "hide" para mostrar la imagen con transición
            currentImageIndex = (currentImageIndex + 1) % images.length;
          }, 1000); // Espera 0.5 segundos (ajusta el valor según la duración de la transición)
        }

        setInterval(changeImage, 5000); // Cambiar cada 3 segundos (ajusta el valor según tus necesidades)
      </script>

      <?php
      // Procesar el formulario al enviar (POST request)
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
        $email = htmlspecialchars($_POST['email']);
        $celular = htmlspecialchars($_POST['celular']);
        $nivel = htmlspecialchars($_POST['nivel']);

        // Ejemplo de una simple validación
        if (empty($nombre) || empty($apellido) || empty($email) || empty($celular) || empty($nivel)) {
          echo "<p>Por favor, completa todos los campos.</p>";
        } else {
          echo "<p>¡Formulario enviado con éxito!</p>";
          // Guardar o procesar los datos
        }
      }
      ?>

      <div class="container animacionMV p-1 mt-1">
        <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
        <h3 class=" mb-2 pb-2 courses__title" style="color:rgb(177, 22, 22)  ; font-weight: bold;">
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
        <div class="imagen-formulario">
          <img src="../img/colegiala_formulario002.png" alt="Imagen Informativa">
          <!-- Modal de Términos y Condiciones -->
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
      </div>

      <div class="datos-institucionales container pt-1 mt-1 mb-0">
        <hr style="color: rgb(177, 22, 22); height: 2px; border: 1px solid rgb(177, 22, 22); opacity: 1;">
        <h3 class=" pb-2 courses__title"><i class="fas fa-database icon-border"></i>Datos del Colegio </h3>
        <div class="row py-2 mt-2 pb-2">
          <div class="col-md-3 ">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="430">0</h3>
              <p>Estudiantes de inicial</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="400"></h3>
              <p>Estudiante de primaria</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="300">0</h3>
              <p>Estudiantes de secundaria</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="contenido-datos d-flex flex-column justify-content-center align-items-center">
              <h3 class="text-center contador" data-target-value="16">0</h3>
              <p>Docentes</p>
            </div>
          </div>
        </div>
      </div>

      <script>
        // contador.js
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
            if (progress < 1) {
              window.requestAnimationFrame(step);
            }
          };
          window.requestAnimationFrame(step);
        }

        function animateOnIntersection(entries, observer) {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const targetElement = entry.target;
              const targetValue = parseInt(targetElement.dataset.targetValue, 10);
              animateValue(targetElement, 0, targetValue, 2000);
              observer.unobserve(targetElement);
            }
          });
        }

        // Configurar el IntersectionObserver para la animación
        const options = {
          threshold: 0.1 // La animación se activa cuando el 10% de la sección es visible en la ventana
        };
        const observer = new IntersectionObserver(animateOnIntersection, options);

        // Agregar los elementos con la clase "contador" al IntersectionObserver
        const contadores = document.querySelectorAll(".contador");

        contadores.forEach((contador) => {
          observer.observe(contador);
        });
      </script>

      <!-- Contenedor principal NOTICIAS -->
      <div class="container p-2 mt-0 pb-2">
        <!-- Título del contenido -->
        <div class="row mb-3">
          <div class="title-noticias col-12">
            <hr style="color: rgb(177, 22, 22); height: 2px; border: 2px solid rgb(177, 22, 22); opacity: 1;">
            <h3 class=" courses__title"><i class="fas fa-newspaper icon-border"></i>Ultimas
              Noticias </h3>
          </div>
        </div>
      </div>

      <div class="wow fadeIn" data-wow-delay="0.1s"" >
      <div class=" container gird-news">
      </div>

    </div>
  </div>
  </div>

  <?php
  require_once './components/footer.php'
  ?>
  <script>
    async function obtenerNoticias() {
      const myForm = new FormData()
      myForm.append("modulo_noticia", "obtener")
      const URL = "../ajax/noticia_ajax.php"
      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        })
        const json = await res.json();
        if (json.length === 0) {
          const $gridNotice = document.querySelector(".gird-news");
          $gridNotice.innerHTML = `<h1 class="new__void">No hay noticias</h1>`
        } else {
          const jsonFilter = filterByImportant(json)
          painNotices(jsonFilter)
        }
      } catch (err) {
        const $gridNotice = document.querySelector(".gird-news");
        $gridNotice.innerHTML = `<h1 class="new__void">Error en el servidor</h1>`
      }
    }

    function formatearFecha(fechaString) {
      const meses = [
        'ene', 'feb', 'mar', 'abr', 'may', 'jun',
        'jul', 'ago', 'sep', 'oct', 'nov', 'dic'
      ];
      const fecha = new Date(fechaString);
      const dia = fecha.getDate();
      const mes = meses[fecha.getMonth()];
      return {
        dia: (dia < 10 ? '0' : '') + dia,
        mes: mes.toUpperCase()
      };
    }

    function filterByImportant(noticias) {
      const importantData = noticias.sort((a, b) => {
        const comparacionImportancia = b.importante - a.importante;
        if (comparacionImportancia === 0) {
          const fechaA = new Date(a.fechaCreacion);
          const fechaB = new Date(b.fechaCreacion);
          return fechaB - fechaA;
        }
        return comparacionImportancia;
      });
      return importantData
    }

    function painNotices(data) {
      const $gridNotice = document.querySelector(".gird-news");
      let modifyData = data
      if (modifyData.length == 0) {
        $gridNotice.innerHTML = `<h1>No hay noticias</h1>`
        return;
      }
      if (modifyData.length > 4) {
        modifyData = data.slice(0, 4)
      }
      if (modifyData.length == 1) {
        $gridNotice.style.gridTemplateColumns = `100%`
      } else if (modifyData.length == 2) {
        $gridNotice.style.gridTemplateColumns = `100%`
      } else if (modifyData.length == 3) {
        $gridNotice.style.gridTemplateColumns = `48% 48%`
      } else if (modifyData.length == 4) {
        $gridNotice.style.gridTemplateColumns = `33% 33% 33%`
      }
      modifyData.forEach((notice, idx) => {
        const fecha = formatearFecha(notice.fechaCreacion)
        $gridNotice.innerHTML += `
              <div class="new ${idx == 0 ? "first-new" : ""} ${idx == 3 ? "last-new" : ""}" id="notice-card-index" data-set="${notice.id}">
              <div class="new__decoration"></div>  
              <img src="<?= $GLOBALS['images'] ?>${notice.portada}" alt="image">
                <div class="new__circle">
                  <p>${fecha.dia} <br> </p>
                  <span>${fecha.mes}</span>
                </div>
                <h2>${notice.titulo}</h2>
              </div>
      `
      })
    }
    document.addEventListener('click', e => {
      if (e.target.id == "notice-card-index") {
        const id = e.target.getAttribute("data-set")
        window.location.href = `./noticia.php?id=${id}`;
      }
    })
    obtenerNoticias()
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>