<style>
  .modal-header-2 {
    background-image: url("/images/template/cantv.png");
    background-size: cover;
    color: #fff;
  }

  .modal-footer-2 {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #modalBody-centro {
    overflow: auto;
    height: 70vh;
    scroll-behavior: auto
  }

  #exampleModal {
    overflow: hidden;
  }
</style>

<div class="modal fade" id="Modal-UAI" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
          Registro del Personal
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="modalBody-centro" class="modal-body">
        <form x-data="{
            input: '',
            transformedInput: () => {
                console.log(this.input.replace(/\s/g, '').toUpperCase())
                return this.input.replace(/\s/g, '').toUpperCase();
            }
        }">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">P00:</label>
            <input type="number" class="form-control" id="recipient-name" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Primer Nombre:</label>
            <input x-model="this.input" x-on:input="transformedInput" x-on:keydown.prevent.letters x-init="input = ''" type="text" class="form-control" id="recipient-name" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Segundo Nombre:</label>
            <input type="text" class="form-control" id="recipient-name" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Primer Apellido:</label>
            <input type="text" class="form-control" id="recipient-name" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Segundo Apellido:</label>
            <input type="text" class="form-control" id="recipient-name" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Cédula:</label>
            <input type="text" class="form-control" id="recipient-cedula" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Teléfono:</label>
            <input type="text" class="form-control" id="recipient-telefono" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Correo Institucional:</label>
            <input type="text" class="form-control" id="recipient-email_cantv">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Gerencia:</label>
            <input type="text" class="form-control" id="recipient-cedula" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Cargo:</label>
            <input type="text" class="form-control" id="recipient-cedula" />
          </div>
        </form>
      </div>
      <div class="modal-footer-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          cerrar
        </button>
        <button type="button" class="btn btn-primary">guardar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function form() {
    return
  }
</script>
