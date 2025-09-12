<style>
  .categoria__modal {
    width: 100%;
    box-shadow: 0px 0px 2px 2px #0001;
    background-color: white;
    border-radius: 0.3rem;
    height: 600px;
    overflow: auto;
    padding: 1rem 1rem;
  }

  .categoria__modal h2 {
    font: normal normal 700 1rem/1.5rem var(--font-primary);
  }

  .categoria__modal input,
  .categoria__modal textarea {
    background-color: white;
    box-shadow: 0px 0px 1px 1px #0001;
    border-radius: 0.3rem;
    border: none;
    font: normal normal 400 0.8rem/1rem var(--font-primary);
    width: 100%;
    outline: none;
  }

  .categoria__modal textarea {
    resize: none;
    height: 70px;
  }

  .categoria__modal label {
    font: normal normal 400 0.8rem/1rem var(--font-primary);
    display: block;
    margin-bottom: 0.5rem;
  }

  .categoria__modal input[type="submit"] {
    padding: 0.5rem 2rem;
    border: none;
    border-radius: 0.3rem;
    background-color: #173f78;
    text-transform: uppercase;
    color: white;
    font: normal normal 700 0.7rem/1rem var(--bs-font-sans-serif);
    transition: 0.3s;
  }

  .categoria__modal input[type="submit"]:hover,
  .categoria__modal input[type="submit"]:focus {
    filter: brightness(0.8);
  }

  .categoria__item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem 1rem;
    border-radius: 0.3rem;
    background: #eeeeee;
  }

  .categoria__item h4 {
    font: normal normal 700 0.8rem/1rem var(--font-primary);
    margin: 0
  }

  .categoria__item button {
    border-radius: 1rem;
    border: none;
    background: #c0c0c0;
    width: 1.5rem;
    height: 1.5rem;
    display: grid;
    place-items: center;
    transition: 0.3s;
  }

  .categoria__item button:hover,
  .categoria__item button:focus {
    filter: brightness(0.8);
  }


  .categoria__item i {
    font-size: 0.8rem;
  }

  .content__data {
    display: grid;
    gap: 1rem;
  }

  #categoriasModalLoader {
    font: normal normal 700 0.8rem/1rem var(--font-primary);
  }

  #errorCategoriaModal {
    font: normal normal 700 0.8rem/1rem var(--font-primary);
    margin-bottom: 2rem;
    display: block;
    color: #dc3545;
  }

  .input-checkbox {
    display: flex;
    align-items: center;
    gap: 0.3rem;
  }

  .input-checkbox input {
    display: flex;
    width: 12px !important;
  }

  .--label--special {
    position: relative;
    top: 0.3rem;
  }

  i {
    pointer-events: none
  }
</style>

<div class="categoria__modal">
  <h2>Crea y mira tus categorias</h2>
  <form method="post" id="formCategoria" class="content__form">
    <input type="hidden" name="modulo_categoria" value="crear">
    <div>
      <label for="nombre">Ingresa el nombre: </label>
      <input name="nombre" type="text" class="form-control" max="100" placeholder="Ingresa el nombre de tu categoria..."
        required>
    </div>
    <div class="mt-3">
      <label for="descripcion">Ingresa una descripcion: </label>
      <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10" max="200"
        placeholder="Ingresa una pequeña descripcion..." required></textarea>
    </div>
    <div class="form-check  input-checkbox">
      <input class="form-check-input" type="checkbox" name="privado">
      <label class="form-check-label m-0 --label--special" for="privado">
        ¿Esto será privado?
      </label>
    </div>
    <input type="submit" value="Crear categoria" class="mt-3">
  </form>
  <hr>
  <span id="categoriasModalLoader">Cargando categorias...</span>
  <span id="errorCategoriaModal"></span>
  <div class="content__data" id="categoriasModal">
  </div>
</div>

<script>
  const $categoriasModal = document.getElementById("categoriasModal")
  const $loaderCategorias = document.getElementById("categoriasModalLoader")
  const $formCategoria = document.getElementById("formCategoria")
  const $errorCategoriaModal = document.getElementById("errorCategoriaModal")

  async function obtenerCategoriasModal()
  {
    const URL = "../ajax/categoria_ajax.php?categoriasPrivado"
    try {
      $loaderCategorias.style.display = "block"
      const res = await fetch(URL)
      const json = await res.json()
      console.log(json)
      paintCategoriesModal(json)
    } catch (error) {
      $categorias.innerHTML += "<b>Surgio un error: </b>" + error
    } finally {
      $loaderCategorias.style.display = "none"
    }
  }

  function paintCategoriesModal(data)
  {
    data.forEach(categoria =>
    {
      if (categoria.nombre === "Comunicados") {
        $categoriasModal.innerHTML += `
      <div class="categoria__item">
        <h4>${categoria.nombre}</h4>
      </div>`
      } else {
        $categoriasModal.innerHTML += `
      <div class="categoria__item">
        <h4>${categoria.nombre}</h4>
        <button data-id="${categoria.id}" class="remove-categoria"><i class="fas fa-trash-alt"></i></button>
      </div>`
      }
    })
  }


  async function crearCategoriaModal(data)
  {
    const URL = "../ajax/categoria_ajax.php"
    const res = await fetch(URL, {
      method: "POST",
      body: data
    })
    const json = await res.json();
    window.location.href = "./crear_noticia.php";
  }

  async function eliminarCategoriaModal(data)
  {
    const URL = "../ajax/categoria_ajax.php"
    try {
      const res = await fetch(URL, {
        method: "POST",
        body: data
      })
      const json = await res.json();
      $errorCategoriaModal.innerHTML = ""
      window.location.href = "./crear_noticia.php";
    } catch (error) {
      $errorCategoriaModal.innerHTML =
        "No puedes eliminar esta categoria, ya que una noticia utiliza esta categoria, asegurate de que ninguna noticia use esta categoria."

      setTimeout(() =>
      {
        $errorCategoriaModal.innerHTML = ""
      }, 5000);
    }
  }

  $formCategoria.addEventListener("submit", (e) =>
  {
    e.preventDefault()
    const formData = new FormData($formCategoria)
    crearCategoriaModal(formData)
  })

  document.addEventListener("click", (e) =>
  {
    const className = e.target.className
    const attributeCategoria = e.target.getAttribute("data-id")
    if (className === "remove-categoria") {
      const formDataDelete = new FormData()
      formDataDelete.append("modulo_categoria", "eliminar")
      formDataDelete.append("id", `${attributeCategoria}`)
      eliminarCategoriaModal(formDataDelete)
    }
  })
  obtenerCategoriasModal()
</script>