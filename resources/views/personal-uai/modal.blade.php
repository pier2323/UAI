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
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Código </label>
                        <input type="text" class="form-control" id="recipient-name" />
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">P00</label>
                        <input type="text" class="form-control" id="recipient-name" />
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre  Completo </label>
                        <input type="text" class="form-control" id="recipient-name" />
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Profesión</label>
                        <input type="text" class="form-control" id="recipient-name" />
                        <label for="recipient-name" class="col-form-label">Cédula
                        </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Teléfono </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Correo Institucional </label>
                        <input type="text" class="form-control" id="recipient-cedula">
                        <label for="recipient-name" class="col-form-label">Unidad de acripcion </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Gerencia </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Cargo  que ocupa</label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        
                        <br>
                        <div class="mb-3">
                            <label for="startDate">Fecha de Ingreso</label>
                            <input type="date" name="date" id="dateIni" value="2024-05-09" min="2016-04-27"
                                max="3000-05-09" class="form-control" />
                        </div>
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
