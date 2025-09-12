<style>
  .modal__create__container {
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
  }
 
  .categoria2 {
  display: flex;
  align-items: center; /* Alinea verticalmente los elementos */
  justify-content: center; /* Centra horizontalmente los elementos */
  margin-left: 10px;
  width: 100%; /* Ocupa todo el ancho disponible */
}
  .nueva__categoria { 
    display: flex; /* Hace que los elementos dentro de .nueva__categoria sean flexibles */
    align-items: center; /* Centra el contenido verticalmente */
    order: 3; /* Coloca este elemento al final */
}
  .nav-product {
    display: flex;
  }
  .modal-product-active {
    visibility: hidden;
    opacity: 0;
  }

  .modal__create__bg {
    width: 100%;
    height: 100vh;
    overflow: auto;
    position: fixed;
    background: #0003;
    z-index: 50000;
    display: grid;
    place-items: center;
    padding: 1rem 2rem;
    left: 0;
    top: 0;
    transition: 0.3s;

  }

  .container {
    display: none;
  }

  @media (min-width: 770px) {
    .container {
      display: block;
      width: 230px;
    }

    .modal__create__bg {
      grid-template-columns: 230px auto;
    }
  }

  

  .input__container label {
    margin-right: 0px; /* Espacio entre la etiqueta y el input */
}

.input__container {
  flex: 0 0 45%; /* Reducir el tamaño del contenedor */
}

.boton__categoria {
  margin-left: -10rem; /* Ajusta el margen izquierdo para mover el botón de agregar de categoría hacia la izquierda */
}
.boton__marca {
  margin-left: -10rem; /* Ajusta el margen izquierdo para mover el botón de agregar de marca hacia la izquierda */
}
.input__container__categoria {
  margin-right: 1rem; /* Ajusta el margen derecho para separar el input de categoría del elemento de marca */
  flex: 0 0 45%; /* Reducir el tamaño del contenedor */
}

.input__container__marca {
  margin-left: 1rem; /* Ajusta el margen izquierdo para separar el input de marca del elemento de categoría */
  flex: 0 0 45%; /* Reducir el tamaño del contenedor */
}

.modal__create__container {
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
  }

  .input__container label span {
    color: #FE4164;
  }

  .modal__create__checkbox {
    display: flex;
    gap: 2rem;
    align-items: center;
  }

  .form-group.form-check {
    display: flex;
    gap: 0.5rem;
  }

  .modal__create__buttons {
    width: 100%;
    display: flex;
    justify-content: end;
    margin-top: 2rem;
  }

  .modal__create__buttons__container {
    display: flex;
    gap: 1rem;
  }

  .modal__form {
    padding: 2rem;
  }

  .input__container button {
    background-color: transparent;
    border: none;
    font: normal normal 700 12px/14px Arial;
  }

  .title {
    background-color: #252b3d;
    width: 100%;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .title p {
    margin: 0;
    color: #fff;
    font-weight: bold
  }

  .title button {
    border-radius: 5rem;
    display: grid;
    place-items: center;
    border: none;
    background-color: #fff2;
    width: 30px;
    height: 30px;
  }

  .title i {
    color: white;
  }

  .modal__menu {
    margin: 1rem 2rem 0 2rem;
    display: flex;
    border-bottom: 2px solid #0002;
  }

  .btn-transparent {
    padding: 0.5rem 2rem;
    cursor: pointer;
    background-color: transparent;
    margin: 0;
    position: relative;
    border: none;
    outline: none;
  }

  .modal-product-active {
    visibility: hidden;
    opacity: 0;
  }

  @media (min-width: 720px) {
    .modal__create__form {
      display: grid;
      grid-template-columns: repeat(2, 48%);
      gap: 2%;
      justify-content: space-between;
    }
  }

  .modal__form__root div {
    transition: 0.3s;
  }

  #form__1,
  #form__2,
  #form__3 {
    background-color: white;
  }

  .show__image {
    border: 2px dashed #0002;
    width: 250px;
    height: 300px;
    border-radius: 14px;
    overflow: hidden;
    display: grid;
    place-items: center;
    transition: 0.3s;
    cursor: pointer;
  }

  .show__image p {
    font: normal normal 400 80px/100px Arial;
    color: #0002;
    transition: 0.3s;
  }

  .show__image:hover {
    border: 2px dashed rgb(60, 141, 188);
  }

  .show__image__input {
    opacity: 0;
    position: absolute;
  }

  .show__image:hover p {
    color: rgb(60, 141, 188);
  }

  .show__image img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    /* Quitar cuando se agregue la logica */
    display: none;
  }

  .modal__flex {
    display: flex;
    flex-direction: column; /* Cambiar la dirección a columna */
}

  .modal__grid {
    display: grid;
    width: 100%;
    grid-template-columns: 2fr 5fr 1fr;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }
  .modal__container__form__width {
    width: 100%; /* Ajustar el ancho al 100% */
}




  .btn-active-transparent {
    border-bottom: 3px solid #3c8dbc;
    bottom: -3px;
  }

  .add-padding {
    padding: 3rem
  }
</style>
<script type="text/javascript" src="../js/producto_servicio.js?rev=<?php echo time(); ?>"></script>

<?php
  require ("./modal.php");
 

  ?>



<div class="modal__create__bg modal-product-active" id="modal-product">
  <div class="container"></div>
  <div class="modal__create__container">
    <div class="title">
      <p>Nuevo producto</p>
      <button onclick="switchCreateProduct()">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>

    </div>

    <div class="modal__menu">
      <button class="btn-transparent btn-active-transparent" id="button__1">Atributos</button>
      <button class="btn-transparent" id="button__2">Tipo de clientes</button>
    </div>


    <form action="" class="modal__form">

      <div id="modal__form__root">
        <div id="form__1">
          <div class="modal__create__checkbox">
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="igv">
              <label class="form-check-label" for="igv">Incluye IGV</label>
            </div>
          </div>
          <div class="modal__create__form">
            <div>
              <div class="input__container">
                <label for="descripcion">Nombre <span>*</span></label>
                <input type="text" id="descripcion" class="form-control" required />
              </div>
              <div class="input__container">
                <label for="detalle">Detalle</label>
                <input type="text" id="detalle" class="form-control" required />
              </div>
              <div class="modal__create__form">
                <div class="input__container">
                  <label for="moneda">Moneda</label>
                  <select class="form-control" id="moneda">
                    <option value="SOL">Soles</option>
                    <option value="USD">Dolares</option>
                  </select>
                </div>
                <div class="input__container">
                  <label for="precioBaseUnitario">Precio unitario <span>*</span> </label>
                  <input type="number" id="precioBaseUnitario" class="form-control" required />
                </div>
              </div>
              
          </div>
            <div class="">
              <div class="input__container">
                <label for="nombre-secundario">Nombre secundaria</label>
                <input type="text" id="nombre-secundario" class="form-control" required />
              </div>
              <div class="modal__create__form">
                <div class="input__container">
                  <label for="modelo">Modelo</label>
                  <input type="text" id="modelo" class="form-control" required />
                </div>
                <div class="input__container">
                  <label for="unidad">Unidad</label>
                  <select class="form-control" id="unidad">
                    <option>Bolsa</option>
                    <option>Botella</option>
                    <option>Caja</option>
                    <option>Ciento</option>
                    <option>Cuarto de docena</option>
                    <option>Docena HD - Media docena</option>
                    <option>Galones</option>
                    <option>Gramos</option>
                    <option>Hora</option>
                    <option>Kilos</option>
                    <option>Litros</option>
                    <option>Metro Cubico</option>
                    <option>Metros</option>
                    <option>Millar</option>
                    <option>Millares</option>
                    <option>Paquete</option>
                    <option>Pies</option>
                    <option>Pulgadas</option>
                    <option>Servicio</option>
                    <option>Toneladas</option>
                    <option class="selected">Unidades</option>
                    <option>Yardas</option>
                  </select>
                </div>
              </div>

              <div class="input__container">
              <label for="afectacion">Tipo de afectación</label>
                <select class="form-control" id="afectacion">
                  <option class="selected">Gravado - Operación Onerosa</option>
                  <option>Gravado – Retiro por premio</option>
                  <option>Gravado – Retiro por donación</option>
                  <option>Gravado – Retiro</option>
                  <option>Gravado – Retiro por publicidad</option>
                  <option>Gravado – Bonificaciones</option>
                  <option>Gravado – Retiro por entrega a trabajadores</option>
                  <option>Exonerado - Operación Onerosa</option>
                  <option>Exonerado – Transferencia Gratuita</option>
                  <option>Inafecto - Operación Onerosa</option>
                  <option>Inafecto – Retiro por Bonificación</option>
                  <option>Inafecto – Retiro</option>
                  <option>Inafecto – Retiro por Muestras Médicas</option>
                  <option>Inafecto - Retiro por Convenio Colectivo</option>
                  <option>Inafecto – Retiro por premio</option>
                  <option>Inafecto - Retiro por publicidad</option>
                  <option>Inafecto - Transferencia gratuita</option>
                  <option>Exportación de bienes o servicios</option>
                </select>
              </div>
              
            </div>
          </div>
        </div>
        <div id="form__2" style="opacity: 0; visibility: hidden; position: absolute">
        
    <div class="modal__flex">
      <div class="modal__container__form__width">
        <div class="categoria2">
            <div  class="input__container__categoria">
                <label for="categoria">Categoria</label>
                <div class="alin_global">
                    <select style= width:70% name="categoria" id="categoria" class="form-control"></select>
                    <button style="margin-left: 10px;" class="btn btn-primary" onclick="switchModal()">
                      <em class="fa fa-plus"></em>
                    </button>   
                </div>
            </div>

            <!-- <div class="boton__categoria">
              <button class="btn btn-primary" onclick="switchModal()">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button>
            </div> -->

            <div class="input__container__marca">
                <label for="marca">Marca</label>
                <div class="alin_global">
                    <select style= width:70% name="marca" id="marca" class="form-control"></select>
                    <button style="margin-left: 10px;" class="btn btn-primary" onclick="switchModalMarca()">
                      <em class="fa fa-plus"></em>
                    </button>   
                </div>
            </div>

            <!-- <div class="boton__marca">
              <button class="btn btn-primary"onclick="switchModalMarca()">
              <i class="fa fa-plus" aria-hidden="true"></i>
             </button>
            </div> -->

        </div>
      </div>
    </div>

    
</div>

      </div>
      <div class="modal__create__buttons">
        <div class="modal__create__buttons__container">
          <button class="btn btn-danger">Cancelar</button>
          <button class="btn btn-primary">Registrar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="col-md-12">
  <div class="box box-warning" id="content">
    <div class="box-header with-border nav-product" id="Titulo_Center">
      <h5 class="box-title"><strong>Servicios</strong></h5>
      <button class="btn btn-primary" onclick="switchCreateProduct()"> <i class="fa fa-plus" aria-hidden="true"></i>
        Nuevo </button>
    </div>
    <div class="add-padding">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-4 clasbtn_exportar">
            <div class="input-group" id="btn-place"></div>
          </div>

          <div class="col-md-6 pull-right">
            <div class="alin_global">
              <input type="text" class="global_filter form-control " id="global_filter"
                placeholder="Ingresar dato a buscar" style=" width: 100%">
            </div>
          </div>
        </div>
      </div>
      <table id="tabla_data" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Modelo</th>
            <th>Unidad</th>
            <th>Moneda</th>
            <th>P. Unitario (Venta)</th>
            <th>Tiene IGV (Venta)</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>



<script>
  function switchCreateProduct()
  {
    const $modal = document.getElementById("modal-product")
    $modal.classList.toggle("modal-product-active")
  }
  function switchModalMarca()
  {
    const $modal = document.getElementById("modalmarca")
    $modal.classList.toggle("modalmarca-active")
  }
  ;
  function switchModal()
  {
    const $modal = document.getElementById("modal")
    $modal.classList.toggle("modal-active")
  }
  ;

  function configModal()
  {
    const buttonsAndForms = {
      "button__1": "form__1",
      "button__2": "form__2"
    }

    const relations = Object.entries(buttonsAndForms)
    console.log(relations)
    relations.forEach(i =>
    {
      const buttons = i[0]
      const $button = document.getElementById(buttons)


      $button.addEventListener("click", () =>
      {

        relations.forEach(k =>
        {
          const $buttonRelations = document.getElementById(k[0])
          const $formRelations = document.getElementById(k[1])
          $formRelations.style.opacity = "0"
          $formRelations.style.visibility = "hidden"
          $formRelations.style.bottom = "0px"
          $buttonRelations.style.borderBottom = "none"
          $formRelations.style.top = "0"
          $formRelations.style.position = "absolute"
        })
        const $form = document.getElementById(buttonsAndForms[buttons])
        $button.style.borderBottom = "3px solid #3c8dbc"
        $button.style.bottom = "-3px"
        $form.style.opacity = "1"
        $form.style.visibility = "visible"
        $form.style.position = "relative"
      })
    })
  }


  configModal()
</script>