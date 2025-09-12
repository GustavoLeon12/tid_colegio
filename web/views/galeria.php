<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace a Bootstrap JS y Popper.js (necesario para algunos componentes de Bootstrap) -->
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/galeria.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <!-- Libraries Stylesheet -->
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
  <title>Colegio Orion - Galeria</title>
</head>

<body>

  <?php
  require_once './components/navigation.php';
  ?>


  <!-- Contenido principal -->
  <div class="main-content">

    <div class="banner-galeria d-flex justify-content-center align-items-center">
      <div class="dark-container content text-center text-white">
        <h3 class="text-center">Galería de los estudiantes <br> del colegio orion</h3>
        <p>Convivencia de los estudiantes</p>
      </div>
    </div>


    <!-- Gallery Start -->
    <div class="container-fluid pt-4 pb- mb-2">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2" style="font-weight:bold;">Nuestra Galeria</span>
          </p>

        </div>
        <div class="row">
          <div class="col-12 text-center mb-2">
            <ul class="list-inline mb-4" id="portfolio-flters">
              <li class="btn-galeria btn  m-1 active" data-filter="*">
                Todo
              </li>
              <li class="btn-galeria btn  m-1 " data-filter=".first">
                Inicial
              </li>
              <li class="btn-galeria btn  m-1" data-filter=".second">
                Primaria
              </li>
              <li class="btn-galeria btn  m-1" data-filter=".third">
                Secundaria
              </li>
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/inicial/DSC00529.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/inicial/DSC00529.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/primaria/DSC00625.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/primaria/DSC00625.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item third">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/secundaria/DSC00766.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/secundaria/DSC00766.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/inicial/DSC00536.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/inicial/DSC00536.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/primaria/DSC00634.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/primaria/DSC00634.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 portfolio-item third">
            <div class="position-relative overflow-hidden mb-2">
              <img class="img-fluid w-100" src="../img/galeria/secundaria/DSC00791.jpg" alt="" />
              <div class="portfolio-btn  d-flex align-items-center justify-content-center">
                <a href="../img/galeria/secundaria/DSC00791.jpg" data-lightbox="portfolio">
                  <i class="fa fa-plus text-white" style="font-size: 60px"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Gallery End -->
  </div>

  <?php
  require_once './components/footer.php'
  ?>

  <!-- Enlaces js eventos -->
  <script src="../js/main.js"></script>
  <script src="../js/galeria.js"></script>
  <!-- Enlaces Externos -->



  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/isotope/isotope.pkgd.min.js"></script>
  <script src="../lib/lightbox/js/lightbox.min.js"></script>
  <script src="../js/galeria.js"></script>
</body>
</html>