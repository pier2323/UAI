<div>
    <x-section-basic>
        {{-- <x-button wire:click="downloadWorkingCedula">hola</x-butto> --}}
        <link rel="stylesheet" href="/css/cedula.css">
        <script src="/js/cedula.js"></script>





        <!-- Primer Modal -->
        <div id="firstModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModalAndReset('firstModal', 'checkboxForm')">&times;</span>
                <h4>Selecciona los Checkboxes</h4>
                <form id="checkboxForm">
                    <div class="checkbox-container">
                        <div class="left-column">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox1" name="checkbox1" value=" El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad." checked> El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox2" name="checkbox2" value="El acta esta debidamente certificada por el funcionario autorizada" checked> El acta esta debidamente certificada por el funcionario autorizada </label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox3" name="checkbox3" value=" El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega." checked> El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox4" name="checkbox4" value=" En caso de no recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y el auditor interno del organismo." checked> En caso de no recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y el auditor interno del organismo.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox5" name="checkbox5" value="Lugar de la suscripción del Acta." checked> Lugar de la suscripción del Acta.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox6" name="checkbox6" value="Fecha de la suscripción del Acta" checked> Fecha de la suscripción del Acta.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox7" name="checkbox7" value="Identificación del órgano, entidad, oficina o dependencia que se entrega." checked>Identificación del órgano, entidad, oficina o dependencia que se entrega..</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value=" Identificación de quien entrega" checked> Identificación de quien entrega.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox9" name="checkbox9" value="Motivo de la entrega" checked> Motivo de la entrega.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox10" name="checkbox10" value="Mención expresa de que los anexos forman parte integrante del acta" checked> Mención expresa de que los anexos forman parte integrante del acta.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox25" name="checkbox22" value="Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión." checked> Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión.</label>
                        </div>
                        <div class="right-column">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox12"  name="checkbox12" value="Suscripción del acta de quien entrega." checked> Suscripción del acta de quien entrega.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox13"  name="checkbox13" value="Suscripción del acta de quien recibe." checked> Suscripción del acta de quien recibe.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox14"  name="checkbox14" value=" Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable." checked> Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox15"  name="checkbox15" value="Inventario de los bienes muebles e inmuebles." checked> Inventario de los bienes muebles e inmuebles..</label><br>
                    
                            <label class="checkbox-label"><input type="checkbox" id="checkbox16"  name="checkbox16" value=" Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente." checked> Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox17"  name="checkbox17" value="Indice general del archivo." checked>Indice general del archivo.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox18"  name="checkbox18" value=" Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega." checked> Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox19"  name="checkbox19" value=" El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas." checked> El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox20"  name="checkbox20" value="El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma." checked> El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma.</label><br>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox21" name="checkbox21" value="Monto de los fondos  y bienes asignados Presupuestariamente a la respectiva unidad administradora." checked> Monto de los fondos  y bienes asignados Presupuestariamente  a la respectiva unidad administradora.</label>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="additional-checkboxes">
                        <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value="Estados bancarios actualizados y conciliados." checked> Estados bancarios actualizados y conciliados.</label>
                        <label class="checkbox-label"><input type="checkbox" id="checkbox23" name="checkbox23" value="Lista de comprobantes de gastos." checked>Lista de comprobantes de gastos.</label>
                        <label class="checkbox-label"><input type="checkbox" id="checkbox24" name="checkbox24" value="Cheques emitidos pendientes de cobro.." checked>Cheques emitidos pendientes de cobro.</label>
                    
                    
                    
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
                
                <div class="button-container">
                </div>
            </div>
        </div>
        <!-- Agregar un botón oculto en el HTML, fuera del modal -->
        <button  wire:click='InformeDocumen' id="newButton" style="display: none;" class="btn btn-primary">Descargar Informe del Auditor</button>
        
        <h2>Actas</h2>
        

        {{-- <x-card-handover>
            <x-slot:titulo>Detalles del Acta</x-slot>
            <x-slot:des>
                <li> Codigo de la Actuación:<br> {{ $auditActivity->code }}</li>
                <li> Descripcion :<br>{{ $auditActivity->description }} </li>
                <li> Mes inicio: &nbsp; &nbsp;<br>{{ $auditActivity->month_start }}</li>
                <li>Mes fin:<br>{{ $auditActivity->month_end }}</li>
                <li>Area Encargada:<br>{{ $auditActivity->uai->name }}</li>
                <li>Personal designado:<br>{{$auditActivity->first_name}} </li>
                @foreach ($auditActivity->employee as $employee)
                <p>{{ $employee->first_name }} {{ $employee->first_surname }}</p>
                @endforeach
            </x-slot>
        </x-card-handover> --}}


        <x-card-handover :tabs="['Actas', 'entrante', 'saliente']">

            <x-slot name='Actas'>
                
                <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Detalles del Acta</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">

                        <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                            <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-2x2 font-extrabold">Area Encargada</dt>
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
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight">Area Encargada:<br>{{ $auditActivity->uai->name }}</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight"> @foreach ($auditActivity->employee as $employee)
                                    <p>{{ $employee->first_name }} {{ $employee->first_surname }}</p>
                                    @endforeach</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
                                <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="leading-tight"> Mes inicio: &nbsp; &nbsp;<br>{{ $auditActivity->month_start }}</span>
                            </li>
                            <li class="flex space-x-2 rtl:space-x-reverse items-center">
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

                <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">We invest in the world’s potential</h2>
                    <!-- List -->
                    <ul role="list" class="space-y-4 text-gray-500 dark:text-gray-400">
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Dynamic reports and dashboards</span>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Templates for everyone</span>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Development workflow</span>
                        </li>
                        <li class="flex space-x-2 rtl:space-x-reverse items-center">
                            <svg class="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="leading-tight">Limitless business automation</span>
                        </li>
                    </ul>
                </div>

            </x-slot>


            <x-slot name='saliente'>
                
                <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
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





        <br>
        {{-- <div style="margin-left: 400px; margin-top: -570px;">
            <x-card-handover>
                <x-slot:titulo>Detalles del entrante</x-slot>
                <x-slot:des>
                    <li> Nombre: <br></li>
                    <li> Cedula: <br> </li>
                    <li> P00: <br></li>
                    <li> Cargo: <br></li>
                    <li>telefono: <br></li>
                    <li>Coreo eletronico: <br></li>
                </x-slot>
            </x-card-handover>
        </div> --}}
        {{-- <div style="margin-left: 800px; margin-top: -405px;">
            <x-card-handover>
                <x-slot:titulo>
                    Detalles del Saliente
                </x-slot>
                <x-slot:des>
                    <li> Nombre: <br></li>
                    <li> Cedula: <br></li>
                    <li> P00: <br></li>
                    <li> Cargo: <br></li>
                    <li>telefono: <br></li>
                    <li>Coreo eletronico: <br></li>
                </x-slot>
            </x-card-handover>
        </div> --}}

        <x-button style="margin-top: 200px" wire:click='requeriDocumen'> Requerimiento</x-button>
        <x-button wire:click='programaDocumen'> Programa de trabajo</x-button>
        <x-button style="margin-left:340px" wire:click='CedulaDocumen'>Cedula de trabajo </x-button>
        <x-button wire:click='InformeDocumen'>Informe del Auditor </x-button>

    </x-section-basic>
</div>