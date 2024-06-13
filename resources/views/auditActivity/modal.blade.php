<link rel="stylesheet" href="/css/modal.css">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-2">
                
              <!--Comienzo del modal  --->
            </div>
            <div id="modalBody-centro" class="modal-body">
                <p class="font-sans font-semibold  display:flex  justify-content:center">
                    Datos del Saliente
                   </p>
                <form>
                    <div class="mb-3">
                        <div class="mb-3">
                            <input type="tel" name="phone" id="phone">
                            <script src="/js/libraries/intlTelInput/intlTelInput.js"></script>
                            <script type="module" src="/js/libraries/intlTelInput/execute.js"></script>
                    
                    
                        </div>
            
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Apellido </label>
                        <input type="text" class="form-control" id="recipient-name" />
                        <label for="recipient-name" class="col-form-label">Cédula 
                        </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Teléfono </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <label for="recipient-name" class="col-form-label">Correo </label>
                        <input type="text" class="form-control" id="recipient-cedula">
                        <label for="recipient-name" class="col-form-label">Gerencia </label>
                        <input type="text" class="form-control" id="recipient-cedula" />
                        <br>
                        <p class="font-sans font-semibold  display:flex  justify-content:center">
                         Datos del Entrante
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre </label>
                        <input type="text" class="form-control" id="recipient-name" />
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Apellido </label>
                        <input type="text" class="form-control" id="recipient-name" />
                    </div>
                    <label for="recipient-name" class="col-form-label">Teléfono </label>
                    <input type="text" class="form-control" id="recipient-cedula" />
                    <label for="recipient-name" class="col-form-label">Cédula </label>
                    <input type="text" class="form-control" id="recipient-cedula" />
                    <label for="recipient-name" class="col-form-label">Correo </label>
                    <input type="text" class="form-control" id="recipient-cedula" />
                    <label for="recipient-name" class="col-form-label">Gerencia</label>
                    <input type="text" class="form-control" id="recipient-cedula" />
                    <div class="mb-3">
                        <label for="startDate">Fecha de Sucripcion</label>
                        <input type="date" name="date" id="dateIni" value="2024-05-09" min="2016-04-27"
                            max="3000-05-09" class="form-control" />
                        <label for="endDate">Fecha de Entrega a la UAI</label>
                        <input type="date" name="date" id="dateFin" value="2018-05-10" min="2016-04-28"
                            max="3000-05-10" class="form-control" />
                    </div>
                    <label for="endDate">Fecha de Cese</label>
                    <input type="date" name="date" id="dateFin" value="2018-05-10" min="2016-04-28"
                        max="3000-05-10" class="form-control" />
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
