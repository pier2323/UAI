<div>
    {{-- @dump($auditActivity->id) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 = focus:outline-none shadow-sm';
    @endphp

    <x-section-basic>

      <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            transition: opacity 0.5s ease-in-out; /* Transición de opacidad */
            opacity: 0; /* Inicialmente oculto */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .btn {
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: none;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>

<!-- Primer Modal -->
<div id="firstModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('firstModal')">&times;</span>
        <h4>Selecciona los Checkboxes</h4>
        <form id="checkboxForm">
            <div>
                <input type="checkbox" id="checkbox1" name="checkbox1" value="Checkbox 1"> Checkbox 1<br>
                <input type="checkbox" id="checkbox2" name="checkbox2" value="Checkbox 2"> Checkbox 2<br>
                <input type="checkbox" id="checkbox3" name="checkbox3" value="Checkbox 3"> Checkbox 3<br>
                <input type="checkbox" id="checkbox4" name="checkbox4" value="Checkbox 4"> Checkbox 4<br>
                <input type="checkbox" id="checkbox5" name="checkbox5" value="Checkbox 5"> Checkbox 5<br>
                <input type="checkbox" id="checkbox6" name="checkbox6" value="Checkbox 6"> Checkbox 6<br>
            </div>
        </form>
        <button class="btn btn-primary" onclick="openSecondModal()">Siguiente</button>
        <button class="btn btn-danger" onclick="closeModal('firstModal')">Cerrar</button>
    </div>
</div>

<!-- Segundo Modal -->
<div id="secondModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('secondModal')">&times;</span>
        <h4>Checkboxes no seleccionados</h4>
        <form id="secondForm" action="{{ route('download-excel') }}" method="POST" onsubmit="handleDownload()">
            @csrf
            <div id="uncheckedCheckboxesContainer"></div>
            <button type="submit" class="btn btn-primary">Descargar Excel</button>
        </form>
        <button class="btn btn-danger" onclick="closeModal('secondModal')">Cerrar</button>
    </div>
</div>

<!-- Botón para abrir el primer modal -->
<button class="btn btn-primary" onclick="openModal('firstModal')">Abrir Primer Modal</button>

<script>
    const textosPorDefecto = {
        'checkbox1': 'Texto por defecto para checkbox1',
        'checkbox2': 'Texto por defecto para checkbox2',
        'checkbox3': 'Texto por defecto para checkbox3',
        'checkbox4': 'Texto por defecto para checkbox4',
        'checkbox5': 'Texto por defecto para checkbox5',
        'checkbox6': 'Texto por defecto para checkbox6',
        'checkbox7': 'Texto por defecto para checkbox7',
    };

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'block';
        setTimeout(() => { modal.style.opacity = '1'; }, 10); // Para activar la transición
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.opacity = '0';
        setTimeout(() => { modal.style.display = 'none'; }, 500); // Tiempo para la transición
    }

    function openSecondModal() {
        const checkboxes = document.querySelectorAll('#checkboxForm input[type="checkbox"]');
        const uncheckedContainer = document.getElementById('uncheckedCheckboxesContainer');
        uncheckedContainer.innerHTML = '';

        checkboxes.forEach((checkbox, index) => {
            const inputHidden = document.createElement('input');
            inputHidden.type = 'hidden';
            inputHidden.name = `checkboxes[${index}]`;
            inputHidden.value = checkbox.checked ? '0' : '1'; // Marcados son 0 y no marcados son 1
            uncheckedContainer.appendChild(inputHidden);

            if (!checkbox.checked) {
                const div = document.createElement('div');
                div.textContent = checkbox.value;
                uncheckedContainer.appendChild(div);

                const textarea = document.createElement('textarea');
                textarea.name = `uncheckedCheckboxes[${index}]`;
                textarea.placeholder = `Input for ${checkbox.value}`;
                textarea.value = textosPorDefecto[checkbox.id] || ''; // Mensaje por defecto individual
                uncheckedContainer.appendChild(textarea);
            }
        });

        closeModal('firstModal');
        setTimeout(() => { openModal('secondModal'); }, 500); // Esperar la transición antes de abrir el segundo modal
    }

    function handleDownload() {
        closeModal('secondModal');
        setTimeout(() => {
            document.getElementById('checkboxForm').reset();
            document.getElementById('secondForm').reset();
        }, 1000); // Tiempo de espera antes de limpiar los formularios (ajustable)
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
                            <p>{{ $employee->first_name }} {{ $employee->first_surname }}</p>
                            <P>{{ $employee->p00}} {{ $employee->p00}}</P>
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
