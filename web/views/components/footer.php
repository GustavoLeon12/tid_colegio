<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<footer class="footer text-light pt-4 pb-4">
  <div class="container">
    <div class="row gy-4">
      <!-- Columna del logo -->
      <div class="col-md-6 col-lg-3 text-center">
        <img src="../img/LOGO.png" alt="Logo" class="img-fluid mb-3" width="180">
        <p class="footer__copy">&copy; Colegio Privado Orion <span id="currentYear"></span><br>
          Todos los derechos reservados.</p>
      </div>

      <!-- Columna Contacto + Atención -->
      <div class="col-md-6 col-lg-3">
        <h6 class="footer__title">CONTACTANOS</h6>
        <ul class="footer__list">
          <li><i class="far fa-envelope"></i> colegiooriontarma@gmail.com</li>
          <li><i class="fas fa-phone"></i> 954016787</li>
          <li><i class="fas fa-map-marker-alt"></i> Jr los maizales N° 153</li>
          <li><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/ORIONCOLEGIO" target="_blank" class="custom-link">IEP ORIÓN SEDE TARMA</a></li>
        </ul>

        <h6 class="footer__title mt-3">ATENCIÓN</h6>
        <ul class="footer__list">
          <li>Lunes a Viernes: 6:00am - 6:00pm</li>
          <li>Sábados: 6:00am - 1:00pm</li>
        </ul>
      </div>

      <!-- Columna Páginas de Interés -->
      <div class="col-md-6 col-lg-3">
        <h6 class="footer__title">PÁGINAS DE INTERÉS</h6>
        <ul class="footer__list">
          <li><a href="https://www.gob.pe/minedu" class="custom-link" target="_blank">Ministerio de Educación</a></li>
          <li><a href="https://escale.minedu.gob.pe/ueetendenciasotros" class="custom-link" target="_blank">DRE UGEL</a></li>
          <li><a href="https://ugeltarma-junin.gob.pe/" class="custom-link" target="_blank">UGEL Tarma</a></li>
        </ul>

        <h6 class="footer__title mt-3">Chat Whatsapp</h6>
        <a href="https://wa.link/s816zf" class="whatsapp" target="_blank">
          <i class="fa fa-whatsapp whatsapp-icon"></i>
        </a>
      </div>

      <!-- Columna Facebook -->
      <div class="col-md-6 col-lg-3">
        <h6 class="footer__title">SIGUENOS EN FACEBOOK</h6>
        <div class="footer__facebook mt-3">
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FORIONCOLEGIO&tabs=timeline&width=340&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=889538389821678" width="100%" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
  .footer {
    background: #173F78;
  }

  /* Títulos */
  .footer__title {
    font: normal normal 700 1rem/1.5rem var(--font-primary);
    margin-bottom: .5rem;
  }

  /* Lista */
  .footer__list {
    list-style: none;
    padding-left: 0;
    font-size: 0.85rem;
    line-height: 1.6;
  }

  .footer__list li {
    margin-bottom: .5rem;
    color: #fff;
  }

  .footer__copy {
    font-size: 0.75rem;
    margin: 0;
  }

  /* Enlaces */
  .custom-link {
    text-decoration: none;
    color: #fff;
  }

  .custom-link:hover {
    color: #FFD700;
  }

  /* Botón WhatsApp */
  .whatsapp {
    display: inline-block;
    width: 50px;
    height: 50px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50%;
    text-align: center;
    font-size: 25px;
    line-height: 50px;
    margin-top: 10px;
    transition: transform 0.2s ease-in-out;
  }

  .whatsapp:hover {
    transform: scale(1.1);
  }

  .whatsapp-icon {
    vertical-align: middle;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .footer {
      text-align: center;
    }

    .footer__list {
      font-size: 0.9rem;
    }

    .whatsapp {
      margin: 0 auto;
    }
  }
</style>

<script>
  document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>