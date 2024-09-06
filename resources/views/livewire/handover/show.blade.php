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
                display: none; /* Ocultar por defecto */
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
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
        </style>
    </head>
    <body>
    
    <!-- Primer Modal -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal1">&times;</span>
            <h2>Modal 1</h2>
            <div id="checkboxContainer">
                <label><input type="checkbox" id="checkbox1" value="Checkbox 1"> Checkbox 1</label><br>
                <label><input type="checkbox" id="checkbox2" value="Checkbox 2"> Checkbox 2</label><br>
                <label><input type="checkbox" id="checkbox3" value="Checkbox 3"> Checkbox 3</label><br>
            </div>
            <button id="openModal2">Open Modal 2</button>
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
    </div>
    
    <!-- Botón para abrir el primer modal -->
    <button id="openModal1">Open Modal 1</button>
    
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
        'checkbox5': 'Texto por defecto para checkbox5'
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

        // Función para descargar el archivo Excel
        document.getElementById("downloadExcel").onclick = function() {
            const data = [];
            const inputs = document.querySelectorAll("#uncheckedContainer input[type=text]");
            inputs.forEach(input => {
                data.push({
                    id: input.id,
                    value: input.value
                });
            });
    
            // Aquí puedes hacer una solicitud AJAX para enviar los datos al servidor y generar el archivo Excel
            function loadUncheckedCheckboxes() {
    // ... (mantén esta función exactamente como está)
}

// Función actualizada para descargar el archivo Excel
document.getElementById("downloadExcel").onclick = function() {
    const data = [];
    const textareas = document.querySelectorAll("#uncheckedContainer textarea");
    textareas.forEach(textarea => {
        data.push({
            id: textarea.id,
            value: textarea.value
        });
    });

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
      .catch(error => console.error('Error:', error));
}
        }
    </script>
    
    </body>
        <livewire:Components.AuditActivityHeadings :audit="$auditActivity->id">
            <br>
            <br>
            <br>
            <x-Card>
                <x-slot:titulo>
                    Detalles del Acta
                </x-slot>
                <x-slot:des>
                    <li> Codigo de la Actuación:<br>
                        {{ $auditActivity->code }}</li>
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
                        {{ $auditActivity->comision }}
                    </li>

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



            {{--  PRUEVAsubir archivo y visulizarlo  --}}


{{-- composer require "ext-gd:*" --ignore-platform-reqs --}}
           











    </x-section-basic>
</div>
