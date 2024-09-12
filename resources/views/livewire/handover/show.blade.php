<div>
    {{-- @dump($auditActivity->id) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 = focus:outline-none shadow-sm';
    @endphp

    <x-section-basic>

        <style>
            /* Estilo básico para los modales */
            .modal {
                display: none;
                /* Ocultar por defecto */
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fff5e6;
                /* Color de fondo más cálido */
                margin: 15% auto;
                padding: 40px;
                /* Aumentado el padding */
                border: 1px solid #d4a373;
                /* Borde más cálido */
                width: 70%;
                /* Reducido el ancho */
                max-width: 700px;
                /* Máximo ancho */
                border-radius: 15px;
                /* Bordes redondeados */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .checkbox-container {
                display: flex;
                flex-direction: column;
            }

            .top-checkboxes {
                display: flex;
                justify-content: space-between;
                margin-bottom: 30px;
                /* Aumentado el margen inferior */
            }

            .left-checkboxes,
            .right-checkboxes {
                display: flex;
                flex-direction: column;
                width: 45%;
                /* Ajustado el ancho */
            }

            hr {
                margin: 30px 0;
                /* Aumentado el margen */
                border: 1px solid #e9c46a;
                /* Color más cálido */
                width: 100%;
            }

            .warm-section {
                background-color: #fae1dd;
                /* Color de fondo más cálido */
                padding: 30px;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                border-radius: 10px;
                /* Bordes redondeados */
            }

            .warm-section label {
                margin: 10px 15px;
                /* Aumentado el margen */
            }

            /* Estilo para los checkboxes y labels */
            label {
                color: #6b4f3f;
                /* Color de texto más cálido */
                margin-bottom: 10px;
                /* Espacio entre checkboxes */
                cursor: pointer;
            }

            /* Estilo para el botón */
            button {
                background-color: #d4a373;
                /* Color de fondo cálido */
                color: white;
                border: none;
                padding: 10px 20px;
                margin-top: 20px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #e9c46a;
                /* Color al pasar el mouse */
            }

            /* Estilo para el botón de cerrar */
            .close {
                color: #6b4f3f;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .close:hover {
                color: #e76f51;
            }

            /* Títulos */
            h2 {
                color: #6b4f3f;
                margin-bottom: 20px;
            }
        </style>

        <!-- Primer Modal -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal1">&times;</span>
                <h2>Cedula de trabajo</h2>
                <div class="checkbox-container">
                    <div class="top-checkboxes">
                        <div class="left-checkboxes">

                            <label><input id="checkbox1" type="checkbox" value="Checkbox 1" checked> El acta se entrego en
                                un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario
                                que designe la maxima autoridad.</label>
                            <label><input type="checkbox" id="checkbox2" value="Checkbox 2" checked> El acta esta
                                debidamente certificada por el funcionario autorizada</label>
                            <label><input type="checkbox" id="checkbox3" value="Checkbox 3" checked> El funcionario
                                saliente elaboró, presentó y suscribió la respectiva acta de entrega.</label>
                            <label><input type="checkbox" id="checkbox4" value="Checkbox 4" checked> En caso de no
                                recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el
                                estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y
                                el auditor interno del organismo.</label>
                            <label><input type="checkbox" id="checkbox5" value="Checkbox 5" checked> Lugar de la
                                suscripción del Acta.</label>
                            <label><input type="checkbox" id="checkbox6" value="Checkbox 6" checked> Fecha de la
                                suscripción del Acta.</label>
                            <label><input type="checkbox" id="checkbox7" value="Checkbox 7" checked> Identificación del
                                órgano, entidad, oficina o dependencia que se entrega.</label>
                            <label><input type="checkbox" id="checkbox8" value="Checkbox 8" checked> Identificación de
                                quien entrega.</label>
                            <label><input type="checkbox" id="checkbox9" value="Checkbox 9" checked> Motivo de la
                                entrega.</label>
                            <label><input type="checkbox" id="checkbox10" value="Checkbox 10" checked> Mención expresa
                                de que los anexos forman parte integrante del acta</label>
                            <label><input type="checkbox" id="checkbox11" value="Checkbox 11" checked> Suscripción del
                                acta de quien entrega.</label>
                        </div>
                        <div class="right-checkboxes">
                            <label><input type="checkbox" id="checkbox12" value="Checkbox 12" checked> Suscripción del
                                acta de quien recibe. </label>
                            <label><input type="checkbox" id="checkbox13" value="Checkbox 13" checked> Estado de las
                                cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea
                                aplicable.</label>
                            <label><input type="checkbox" id="checkbox14" value="Checkbox 14" checked> Mención del
                                número de cargos exigentes</label>
                            <label><input type="checkbox" id="checkbox15" value="Checkbox 15" checked> Inventario de los
                                bienes muebles e inmuebles. </label>
                            <label><input type="checkbox" id="checkbox16" value="Checkbox 16" checked> Situación de la
                                ejecución del plan operativo de conformidad con los objetivos propuestos y las metas
                                fijadas en el presupuesto correspondiente.</label>
                            <label><input type="checkbox" id="checkbox17" value="Checkbox 17" checked> Indice general
                                del archivo.</label>
                            <label><input type="checkbox" id="checkbox18" value="Checkbox 18" checked>Datos e
                                información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o
                                función pública del funcionario o empleado que entrega.</label>
                            <label><input type="checkbox" id="checkbox19" value="Checkbox 19" checked> Estado de las
                                cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea
                                aplicable.</label>
                            <label><input type="checkbox" id="checkbox20" value="Checkbox 20" checked> El acta de
                                entrega y sus anexos se elaborarán en original y tres (3) copias certificadas.</label>
                            <label><input type="checkbox" id="checkbox21" value="Checkbox 21" checked> El acta de
                                entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias
                                habiles siguientes a la fecha de suscripción de la misma.</label>

                        </div>
                    </div>
                    <hr> <!-- Línea divisoria -->
                    <div class="warm-section">
                        <label><input type="checkbox" id="checkbox23" value="Checkbox 23" checked> Monto de los fondos y
                            bienes asignados Presupuestariamente
                            a la respectiva unidad administradora.</label>
                        <label><input type="checkbox" id="checkbox24" value="Checkbox 24" checked> Saldo en efectivo de
                            dichos fondos a la fecha de entrega de la gestión.</label>
                        <label><input type="checkbox" id="checkbox25" value="Checkbox 25" checked> Estados bancarios
                            actualizados y conciliados.</label>
                        <label><input type="checkbox" id="checkbox26" value="Checkbox 26" checked> Lista de comprobantes
                            de gastos.</label>
                        <label><input type="checkbox" id="checkbox27" value="Checkbox 27" checked> Cheques emitidos
                            pendientes de cobro.</label>
                    </div>
                    <button id="openModal2">Open Modal 2</button>
                </div>
            </div>
        </div>
        <!-- Segundo Modal -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal2">&times;</span>
                <h2>Modal 2</h2>
                <div id="uncheckedContainer">
                    <!-- Aquí se cargarán los checkboxes no marcados con inputs -->
                </div>
                <button id="downloadExcel">Descargar Excel</button>
            </div>
            <div id="notification-container"></div>
        </div>

        <!-- Botón para abrir el primer modal -->
        <x-button id="openModal1">Open Modal 1</x-button>

        <script>
            // Obtener los elementos del DOM
            const modal1 = document.getElementById("modal1");
            const modal2 = document.getElementById("modal2");
            const openModal1Btn = document.getElementById("openModal1");
            const openModal2Btn = document.getElementById("openModal2");
            const closeModal1Btn = document.getElementById("closeModal1");
            const closeModal2Btn = document.getElementById("closeModal2");

            // Función para abrir el primer modal
            openModal1Btn.onclick = function() {
                modal1.style.display = "block";
            }

            // Función para cerrar el primer modal
            closeModal1Btn.onclick = function() {
                modal1.style.display = "none";
            }

            // Función para abrir el segundo modal
            openModal2Btn.onclick = function() {
                loadUncheckedCheckboxes();
                modal2.style.display = "block";
            }

            // Función para cerrar el segundo modal
            closeModal2Btn.onclick = function() {
                modal2.style.display = "none";
            }

            // Cerrar los modales si el usuario hace clic fuera de ellos
            window.onclick = function(event) {
                if (event.target == modal1) {
                    modal1.style.display = "none";
                } else if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            }

            function loadUncheckedCheckboxes() {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const uncheckedContainer = document.getElementById('uncheckedContainer');
                uncheckedContainer.innerHTML = '';

                const textosPorDefecto = {
                    'checkbox1': 'Texto por defecto para checkbox1',
                    'checkbox2': 'Texto por defecto para checkbox2',
                    'checkbox3': 'Texto por defecto para checkbox3',
                    'checkbox4': 'Texto por defecto para checkbox4',
                    'checkbox5': 'Texto por defecto para checkbox5',

                    'checkbox6': 'Texto por defecto para checkbox1',
                    'checkbox7': 'Texto por defecto para checkbox2',
                    'checkbox8': 'Texto por defecto para checkbox3',
                    'checkbox9': 'Texto por defecto para checkbox4',
                    'checkbox10': 'Texto por defecto para checkbox5',

                    'checkbox12': 'Texto por defecto para checkbox1',
                    'checkbox12': 'Texto por defecto para checkbox2',
                    'checkbox13': 'Texto por defecto para checkbox3',
                    'checkbox14': 'Texto por defecto para checkbox4',
                    'checkbox15': 'Texto por defecto para checkbox5',

                    'checkbox16': 'Texto por defecto para checkbox1',
                    'checkbox17': 'Texto por defecto para checkbox2',
                    'checkbox18': 'Texto por defecto para checkbox3',
                    'checkbox19': 'Texto por defecto para checkbox4',
                    'checkbox20': 'Texto por defecto para checkbox5',


                    'checkbox21': 'Texto por defecto para checkbox1',
                    'checkbox22': 'Texto por defecto para checkbox2',
                    'checkbox23': 'Texto por defecto para checkbox1',
                    'checkbox24': 'Texto por defecto para checkbox2',
                    'checkbox25': 'Texto por defecto para checkbox3',
                    'checkbox26': 'Texto por defecto para checkbox4',
                    'checkbox27': 'Texto por defecto para checkbox5',


                };

                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        const div = document.createElement("div");

                        const label = document.createElement("label");
                        label.htmlFor = checkbox.id;
                        label.appendChild(document.createTextNode(checkbox.value));

                        const textarea = document.createElement("textarea");
                        textarea.id = "input" + checkbox.id;
                        textarea.value = textosPorDefecto[checkbox.id];
                        textarea.style.width = "100%";
                        textarea.style.minHeight = "100px";
                        textarea.style.resize = "none";
                        textarea.style.overflow = "hidden";

                        textarea.addEventListener('input', function() {
                            this.style.height = 'auto';
                            this.style.height = this.scrollHeight + 'px';

                            // Opcional: pasar a la siguiente línea después de cierto número de caracteres
                            const maxCharsPerLine = 50; // Ajusta este valor según tus necesidades
                            const lines = Math.ceil(this.value.length / maxCharsPerLine);
                            this.rows = lines;

                            // Limitar la altura máxima
                            const maxHeight = 300; // por ejemplo, 300px
                            if (this.scrollHeight > maxHeight) {
                                this.style.height = maxHeight + 'px';
                                this.style.overflowY = 'auto';
                            } else {
                                this.style.overflowY = 'hidden';
                            }
                        });

                        div.appendChild(label);
                        div.appendChild(textarea);
                        uncheckedContainer.appendChild(div);
                    }
                });
            }
            document.getElementById("downloadExcel").onclick = function() {
                // Cerrar todos los modales y borrar su contenido
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    const modalContent = modal.querySelector(
                        '.modal-content'); // Seleccionamos el contenedor del contenido del modal
                    modal.classList.add('fade'); // Agregamos la clase fade para la transición
                    modal.classList.remove('show'); // Ocultamos el modal
                    setTimeout(() => {
                        modalContent.innerHTML = ''; // Borrar solo el contenido del contenedor del modal
                    }, 300); // Tiempo de transición (300ms)
                });
                // Resto del código para descargar el archivo Excel...
                const data = [];
                const textareas = document.querySelectorAll("#uncheckedContainer textarea");
                textareas.forEach(textarea => {
                    data.push({
                        id: textarea.id,
                        value: textarea.value
                    });
                });
                // Crear un objeto para almacenar los valores de los checkbox
                var checkboxValues = {};

                // Agregar evento onchange a los checkbox
                $('input[type="checkbox"]').on('change', function() {
                    var id = $(this).attr('id');
                    var value = $(this).prop('checked') ? 1 : 0;
                    checkboxValues[id] = value;
                });
                const notification = document.createElement("div");
                // Mostrar notificación con fondo negro
                notification.innerHTML = "Descarga iniciada...";
                notification.style.position = "fixed"; // Cambiar a fixed para que se posicione en relación con la ventana
                notification.style.top = "10px"; // Posición desde la parte superior
                notification.style.right = "10px"; // Posición desde la parte derecha
                notification.style.transform = "none"; // No necesitamos translate en este caso
                notification.style.background = "black"; // Fondo negro no transparente
                notification.style.padding = "10px";
                notification.style.borderRadius = "10px";
                notification.style.color = "white";
                notification.style.zIndex = "9999"; // Agregar z-index para que se muestre encima de todo
                notification.style.display = "block"; // Agregar display para que se muestre siempre
                // Agregar la notificación directamente al body
                document.body.appendChild(notification);
                // Agregar la transición de entrada
                notification.style.transition = "opacity 0.5s"; // Transición de opacidad durante 0.5 segundos
                setTimeout(() => {
                    notification.style.opacity = 1; // Mostrar la notificación con opacidad 1

                    // Cerrar todos los modales cuando se muestra la notificación
                    const modals = document.querySelectorAll('.modal'); // Selecionar todos los modales
                    modals.forEach(modal => {
                        modal.classList.add(
                            'closing'); // Agregar la clase closing para iniciar la transición de salida
                        setTimeout(() => {
                            modal.classList.remove(
                                'show'); // Quitar la clase show para cerrar el modal
                        }, 300); // 300 milisegundos = 0.3 segundos
                    });
                }, 0); // Iniciar la transición de entrada inmediatamente

                // Cambiar el texto de la notificación después de 12 segundos
                setTimeout(() => {
                    notification.innerHTML = "Descarga finalizada";
                }, 6000); // 12000 milisegundos = 12 segundos

                // Agregar la transición de salida
                setTimeout(() => {
                    notification.style.transition = "opacity 0.5s"; // Transición de opacidad durante 0.5 segundos
                    notification.style.opacity = 0; // Ocultar la notificación con opacidad 0
                    setTimeout(() => {
                        document.body.removeChild(
                            notification); // Remover la notificación después de la transición de salida
                    }, 500); // 500 milisegundos = 0.5 segundos
                }, 10000); // 13000 milisegundos = 13 segundos

                // Aquí puedes hacer una solicitud AJAX para enviar los datos al servidor y generar el archivo Excel
                fetch('/download-excel', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    }).then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'CEDUA.xlsx';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);


                    })




                    .catch(error => {
                        notification.innerHTML = "Error al descargar el archivo";
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 100);
                        console.error('Error:', error);
                    });

                // Refrescar página después de descargar archivo
                setTimeout(function() {
                    location.replace(location.href);
                }, 9000); // Tiempo de espera antes de refrescar la página (3 segundo)
            }
        </script>

        <livewire:Components.AuditActivityHeadings :$auditActivity>
            <br>
            <br>
            <br>
            <x-Card>
                <x-slot:titulo>
                    Detalles del Acta
                </x-slot>
                <x-slot:des>
                    <li> Codigo de la Actuación:<br>
                        {{ $auditActivity->code() }}</li>
                    <li> Descripcion :
                        <br>
                        {{ $auditActivity->description }}
                    </li>
                    <li> Mes inicio: &nbsp; &nbsp;

                        <br>{{ $auditActivity->month_start }}
                    </li>
                    <li>
                        Mes fin:
                        <br>
                        {{ $auditActivity->month_end }}
                    </li>
                    <li>
                        Area Encargada:
                        <br>
                        {{ $auditActivity->uai->name }}

                    </li>
                    <li>
                        Personal designado:
                        <br>
                        {{$auditActivity->first_name}} </li>
                        @foreach ($auditActivity->employee as $employee)
                            <p>{{ $employee->first_name }} {{ $employee->first_surname }}
                            </p>
                        @endforeach


                        
                </x-slot>
            </x-Card>
            <br>
            <div style="margin-left: 400px; margin-top: -570px;">

                <x-Card>
                    <x-slot:titulo>
                        Detalles del entrante
                    </x-slot>
                    <x-slot:des>
                        <li> Nombre: <br></li>
                        <li> Cedula: <br> </li>
                        <li> P00: <br></li>
                        <li> Cargo: <br></li>
                        <li>telefono: <br></li>
                        <li>Coreo eletronico: <br></li>
                    </x-slot>
                </x-Card>

            </div>
            <div style="margin-left: 800px; margin-top: -405px;">
                <x-Card>
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
                </x-Card>
            </div>

            <x-button style="margin-top: 200px" wire:click='requeriDocumen'> Requerimiento</x-button>
            <x-button wire:click='programaDocumen'> Programa de trabajo</x-button>
            <x-button style="margin-left:340px" wire:click='CedulaDocumen'>Cedula de trabajo </x-button>
            <x-button wire:click='InformeDocumen'>Informe del Auditor </x-button>
    </x-section-basic>
</div>
