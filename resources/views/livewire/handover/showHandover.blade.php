<div>

    <h1>hola mundo</h1>
    <x-section-basic>
    {{-- <x-button wire:click="downloadWorkingCedula">hola</x-butto>  --}}
       
            <link rel="stylesheet" href="/css/cedula.css">
            <script src="/js/cedula.js"></script>
    
            
            <!-- Primer Modal -->
            <div id="firstModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModalAndReset('firstModal', 'checkboxForm')">&times;</span>
                    <h4>Desmarque cada casilla según los hallazgos encontrados </h4>
                    <form id="checkboxForm">
                        <div class="checkbox-container">
                            <div class="left-column">
                                <label class="checkbox-label"><input type="checkbox" id="checkbox1" name="checkbox1" value="(A) El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad." checked>(A)  El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox2" name="checkbox2" value="(B) El acta esta debidamente certificada por el funcionario autorizada" checked>(B) El acta esta debidamente certificada por el funcionario autorizada </label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox3" name="checkbox3" value="(C) El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega." checked>(C) El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox5" name="checkbox5" value="(E) Lugar de la suscripción del Acta." checked>(E) Lugar de la suscripción del Acta.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox6" name="checkbox6" value="(F) Fecha de la suscripción del Acta" checked>(F) Fecha de la suscripción del Acta.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox7" name="checkbox7" value="(G) Identificación del órgano, entidad, oficina o dependencia que se entrega." checked>(G) Identificación del órgano, entidad, oficina o dependencia que se entrega..</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value="(H) Identificación de quien entrega" checked>(H) Identificación de quien entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value="(I) Identificación de quien Recibe" checked>(I) Identificación de quien entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox9" name="checkbox9" value="(J) Motivo de la entrega" checked>(J) Motivo de la entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox10" name="checkbox10" value="(l) Mención expresa de que los anexos forman parte integrante del acta" checked> (l)Mención expresa de que los anexos forman parte integrante del acta.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox21"  name="checkbox21" value="(j) El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma." checked> (j) El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma.</label><br>
                           
                            </div>
                            <div class="right-column">
                                <label class="checkbox-label"><input type="checkbox" id="checkbox12"  name="checkbox12" value="(m) Suscripción del acta de quien entrega." checked>(a) Suscripción del acta de quien entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox13"  name="checkbox13" value="(n) Suscripción del acta de quien recibe." checked>(b) Suscripción del acta de quien recibe.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox14"  name="checkbox14" value="(a) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable." checked>(c) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox22"  name="checkbox22" value="(b) Mención del número de cargos exigentes." checked>(d) Mención del número de cargos exigentes.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox15"  name="checkbox15" value="(e) Inventario de los bienes muebles e inmuebles." checked>(e) Inventario de los bienes muebles e inmuebles..</label><br>
                               
                        
                                <label class="checkbox-label"><input type="checkbox" id="checkbox16"  name="checkbox16" value="(f) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente." checked> (f) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox17"  name="checkbox17" value="(g) Indice general del archivo." checked>(g) Indice general del archivo.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox18"  name="checkbox18" value="(h) Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega." checked> (h) Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox19"  name="checkbox19" value="(i) El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas." checked> (i) El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas.</label><br>
                            </div>
                        </div>
                        <hr class="divider">
                        <div class="additional-checkboxes">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value="(c) Estados bancarios actualizados y conciliados." checked>(c) Estados bancarios actualizados y conciliados.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox23" name="checkbox23" value="(d) Lista de comprobantes de gastos." checked>(d) Lista de comprobantes de gastos.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox24" name="checkbox24" value="(e) Cheques emitidos pendientes de cobro.." checked>(e) Cheques emitidos pendientes de cobro.</label>
                        </div>
                        <hr class="divider">
                        <div class="additional-checkboxes">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value=" (b) Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión." checked>(b) Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox20" name="checkbox20" value=" (a) Monto de los fondos  y bienes asignados Presupuestariamente a la respectiva unidad administradora." checked> (a) Monto de los fondos  y bienes asignados Presupuestariamente  a la respectiva unidad administradora.</label>
                    </div>
    
                    <hr class="divider">
                        <div class="additional-checkboxes">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox25" name="checkbox25" value=" Sin Hallazgo" checked>Sin Hallazgo</label>
                    </div>
    
                    </form>
                    <div class="button-container">
                        <button class="btn-modern btn-primary" onclick="openSecondModal()">Siguiente</button>
                        <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
                    </div>
                </div>
            </div>
    
            <!-- Botón para abrir el primer modal -->
            <button class="btn btn-primary" onclick="openModal('firstModal')">Abrir Primer Modal</button>
    
            <!-- Segundo Modal -->
            <div id="secondModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModalAndReset('secondModal', 'secondForm')">&times;</span>
                    <h4>Checkboxes no seleccionados</h4>
                    <form id="secondForm" action="{{ route('download-excel') }}" method="POST" onsubmit="handleDownload(event)">
                        @csrf
                        <div id="uncheckedCheckboxesContainer" style="margin: 20px 0;"></div>
                        <x-button type='submit' class="ml-4" id="downloadButton" onclick="handleDownload()">Descarga exel</x-button>
                        <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
                        <div id="downloadMessage" class="download-message"></div>
                    </form>
                    <div class="button-container"></div>
                </div>
            </div>
    
            <!-- Agregar un botón oculto en el HTML, fuera del modal -->
            <button wire:click='InformeDocumen' id="newButton" style="display: none;" class="btn btn-primary">Descargar Informe del Auditor</button>
         <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los checkboxes excepto "Sin Hallazgo"
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#checkbox25)');
        const sinHallazgoCheckbox = document.getElementById('checkbox25');
        const sinHallazgoLabel = sinHallazgoCheckbox.parentNode;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Verificar si todos los checkboxes están marcados
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                
                if (allChecked) {
                    // Mantener "Sin Hallazgo" activo y marcado
                    sinHallazgoCheckbox.disabled = false;
                    sinHallazgoCheckbox.checked = true;
                    sinHallazgoLabel.style.color = 'black';
                } else {
                    // Bloquear y desmarcar "Sin Hallazgo" si al menos uno está desmarcado
                    sinHallazgoCheckbox.disabled = true;
                    sinHallazgoCheckbox.checked = false;
                    sinHallazgoLabel.style.color = 'gray';
                }
            });
        });

        sinHallazgoCheckbox.addEventListener('change', function() {
            if (!this.checked) {
                // Bloquear y desmarcar "Sin Hallazgo" si se desmarca
                this.disabled = true;
                sinHallazgoLabel.style.color = 'gray';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const btnRequerimiento = document.getElementById('requerimiento');
        const emailForm = document.getElementById('emailForm');
        const sendEmailButton = document.getElementById('sendEmailButton');

        btnRequerimiento.addEventListener('click', function() {
            // Mostrar el formulario de enviar correo con transición
            emailForm.classList.add('show');
        });

        sendEmailButton.addEventListener('click', function() {
            // Ocultar el formulario de enviar correo con transición
            emailForm.classList.remove('show');
        });
    });
    
</script>

        <!-- Agregar un botón oculto en el HTML, fuera del modal -->
        <button  wire:click='InformeDocumen' id="newButton" style="display: none;" class="btn btn-primary">Descargar Informe del Auditor</button>
        

        <h2>Ahola</h2>
        <h2> {{ $auditActivity->handoverDocument->employeeIncoming->first_name }}
        </h2>
    <x-card-handover :tabs="['Actas', 'entrante', 'saliente']">

            <x-slot name='Actas'>
                
                <div class="p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Detalles del Acta</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">

                        <div class="p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                <div class="flex flex-col">
                                    <dt class="mb-2 font-extrabold text-2x2">Area Encargada</dt>
                                    <dd class="text-gray-500 dark:text-gray-400">{{ $auditActivity->uai->name }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                                    <dd class="text-gray-500 dark:text-gray-400">Public repositories</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                                    <dd class="text-gray-500 dark:text-gray-400">Open source projects</dd>
                                </div>
                            </dl>
                        </div> 
        
                        

                        <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                            <li class="flex items-center space-x-2 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Area Encargada:<br>{{ $auditActivity->uai->name }}</span>
                            </li>
                            <li class="flex items-center space-x-2 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight"> @foreach ($auditActivity->employee as $employee)
                                    <p>{{ $employee->first_name }} {{ $employee->first_surname }}</p>
                                    @endforeach</span>
                            </li>
                            <li class="flex items-center space-x-2 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight"> Mes inicio: &nbsp; &nbsp;<br>{{ $auditActivity->month_start }}</span>
                            </li>
                            <li class="flex items-center space-x-2 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Mes fin:<br>{{ $auditActivity->month_end }}</span>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        Learn more
                        <svg class=" w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                </div> 
                
            </x-slot>

            <x-slot name='entrante'>

                <div class="p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in the world’s potential</h2>
                    <!-- List -->
                    <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                        <li class="flex items-center space-x-2 rtl:space-x-reverse">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Dynamic reports and dashboards</span>
                        </li>
                        <li class="flex items-center space-x-2 rtl:space-x-reverse">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Templates for everyone</span>
                        </li>
                        <li class="flex items-center space-x-2 rtl:space-x-reverse">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Development workflow</span>
                        </li>
                        <li class="flex items-center space-x-2 rtl:space-x-reverse">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Limitless business automation</span>
                        </li>
                    </ul>
                </div>

            </x-slot>


            <x-slot name='saliente'>
                
                <div class="p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                    <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                        <div class="flex flex-col">
                            <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                            <dd class="text-gray-500 dark:text-gray-400">Developers</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                            <dd class="text-gray-500 dark:text-gray-400">Public repositories</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                            <dd class="text-gray-500 dark:text-gray-400">Open source projects</dd>
                        </div>
                    </dl>
                </div> 

            </x-slot>

        </x-card-handover>

<p>jakdshkjsahfdo ñoieqñyiroulifygweykufiulQIGEUOLVUCSHAJ</p>
        <div>
            @if ($mensajeExceso)
                <h3>{{ $mensajeExceso }}</h3> <!-- Mostrar mensaje de exceso si existe -->
                <h4>Días excedidos: {{ $diasExcedidos }}</h4> <!-- Mostrar cantidad de días excedidos -->
            @else
                <h3>Han Trascurrido  {{ $diasRestantes }} dias habiles de los 120</h3> <!-- Mostrar días restantes si no hay exceso -->
            @endif
        
            <h4>Días no hábiles:</h4>
            <ul>
                @foreach ($nonBusinessDays as $day)
                <li>{{ $day }}</li> <!-- Ya se imprimen en formato "día/mes/año" -->
            @endforeach
            </ul>
        </div>
<!-- Botón para abrir el requerimiento -->
<x-button style="margin-top: 200px" wire:click='requeriDocumen' id="requerimiento"> Requerimiento</x-button>

<!-- Formulario para enviar correo, inicialmente oculto -->
<form action="{{ url('/enviar-correo-zimbra') }}" method="GET" target="_blank" id="emailForm" style="display: none;">
    <x-button type="submit" id="sendEmailButton">Enviar Requerimiento </x-button>
</form>

<!-- Otros botones -->
<x-button wire:click='programaDocumen'> Programa de trabajo</x-button>
<x-button style="margin-left:340px" wire:click='downloadExcel'>Cedula de trabajo </x-button>
<x-button wire:click='InformeDocumen'>Informe del Auditor </x-button>


     <script>
 const auditCode = "{{ $this->auditActivity->code }}"; // Asignar el código de auditoría a una variable de JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const requerimientoButton = document.getElementById('requerimiento');
    const emailForm = document.getElementById('emailForm');
    const sendEmailButton = document.getElementById('sendEmailButton');
    const uniqueId = `requerimientoButtonState_${auditCode}`; // ID único para almacenar el estado basado en el código de auditoría

    // Ocultar el formulario por defecto
    emailForm.style.display = 'none';

    // Verificar el estado del botón "Requerimiento" en localStorage
    const isRequerimientoDisabled = localStorage.getItem(uniqueId);

    // Si el botón está deshabilitado, cambiar su estado
    if (isRequerimientoDisabled === 'true') {
        requerimientoButton.disabled = true;
        requerimientoButton.innerText = 'Requerimiento Enviado'; // Cambiar el texto del botón
        emailForm.style.display = 'block'; // Mostrar el formulario "Enviar Correo"
    }

    requerimientoButton.addEventListener('click', function() {
        // Aquí puedes agregar la lógica para descargar el documento
        descargarDocumento().then(() => {
            // Desactivar el botón "Requerimiento"
            requerimientoButton.disabled = true;
            requerimientoButton.innerText = 'Requerimiento Enviado'; // Cambiar el texto del botón
            localStorage.setItem(uniqueId, 'true'); // Guardar estado en localStorage
            emailForm.style.display = 'block'; // Mostrar el formulario "Enviar Correo"
            location.reload(); // Recargar la página después de la descarga
        });
    });

    // Evento para enviar el formulario
    sendEmailButton.addEventListener('click', function() {
        // Cambiar el texto del botón a "Enviando Requerimiento"
        sendEmailButton.innerText = 'Enviando Requerimiento'; // Cambiar el texto del botón
        // Aquí puedes agregar la lógica para enviar el correo
    });

    // Doble clic para ocultar el botón "Enviar Correo"
    sendEmailButton.addEventListener('dblclick', function() {
        emailForm.style.display = 'none'; // Ocultar el formulario "Enviar Correo"
    });

    // Agregar eventos para otros botones
    document.querySelectorAll('x-button').forEach(button => {
        button.addEventListener('click', function() {
            // Aquí puedes agregar la lógica para cada uno de los otros botones
            location.reload(); // Recargar la página después de la descarga
        });
    });
});

// Función simulada para descargar el documento
function descargarDocumento() {
    return new Promise((resolve) => {
        // Simulación de un retraso de descarga de 2 segundos
        setTimeout(() => {
            console.log("Documento de requerimiento descargado"); // Aquí puedes manejar la lógica real de descarga
            resolve();
        }, 2000);
    });
}

       </script>
    </x-section-basic>
</div>