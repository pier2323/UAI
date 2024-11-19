<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>

    .container {
        background-color: white; /* Fondo blanco para la carta */
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra suave */
        padding: 20px; /* Aumentar el padding */
        width: 100%; /* Ancho completo */
        margin: 20px 0; /* Margen superior e inferior */
        display: flex;
        flex-direction: column; /* Colocar elementos en columna */
        overflow: hidden; /* Evitar scroll */
    }
    .tabs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        border-bottom: 2px solid #ccc; /* Línea debajo de las pestañas */
    }
    .tab {
        background-color: white; /* Fondo blanco para las pestañas */
        color: #000000; /* Color del texto */
        padding: 10px 15px;
        margin: 0 5px; /* Espaciado entre pestañas */
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px 5px 0 0; /* Bordes redondeados en la parte superior */
        transition: background-color 0.3s;
        flex: 1; /* Para que las pestañas ocupen el mismo espacio */
        text-decoration: none; /* Sin subrayado */
        text-align: center; /* Centrar texto en pestañas */
    }
    .tab:hover {
        background-color: #f0f0f0; /* Fondo gris claro al pasar el ratón */
        color: rgb(0, 0, 0); /* Color del texto en la pestaña activa */
    }
    .active {
        color: rgb(0, 0, 0); /* Color del texto en la pestaña activa */
    }
    #content {
        padding: 20px; /* Aumentar el padding */
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9; /* Fondo gris claro */
        flex: 1; /* Ocupa el espacio restante */
        overflow: hidden; /* Evitar scroll en el contenido */
        display: flex;
        flex-direction: column; /* Para mantener el botón en la parte inferior */
    }
 
    .button-container {
        margin-top: auto; /* Empuja el botón hacia abajo */
        text-align: center; /* Centrar el botón */
    }
    .button {
    background-color: #00fac0; /* Fondo verde */
    color: rgb(255, 255, 255); /* Color del texto */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s; /* Añadir transición para el efecto de transformación */
}

.button:hover {
    background-color: #ff5722; /* Color de fondo llamativo al pasar el ratón (naranja) */
    color: white; /* Mantener el color del texto blanco */
    transform: scale(1.05); /* Aumentar ligeramente el tamaño del botón */
}

.button:active {
    background-color: #d84315; /* Color de fondo más oscuro al hacer clic (naranja oscuro) */
    transform: scale(0.95); /* Reducir ligeramente el tamaño del botón al hacer clic */
}
.column-container {
    display: flex; /* Usar flexbox para las columnas */
    justify-content: space-between; /* Espacio entre columnas */
    margin-bottom: 20px; /* Espacio inferior */
}

.column {
    flex: 1; /* Cada columna ocupa el mismo espacio */
    margin: 0 10px; /* Espacio lateral entre columnas */
    padding: 10px; /* Espacio interno */
    background-color: #f0f0f0; /* Fondo gris claro para las columnas */
    border-radius: 5px; /* Bordes redondeados */
}

.column h3 {
    margin-top: 0; /* Sin margen superior en el título */
}
.button-container {
    display: flex; /* Usar flexbox para alinear las filas */
    flex-direction: column; /* Coloca las filas en una columna */
    gap: 20px; /* Espacio entre las filas */
    margin-top: 20px; /* Margen superior para separación del contenedor */
}

.top-buttons, .bottom-buttons {
    display: flex; /* Usar flexbox para alinear los botones en una fila */
    justify-content: space-between; /* Espacio entre los botones */
    align-items: center; /* Alinear verticalmente */
}

.dynamic-button {
    background-color: #007BFF; /* Color de fondo */
    color: white; /* Color del texto */
    border: none; /* Sin borde */
    border-radius: 5px; /* Bordes redondeados */
    padding: 10px 20px; /* Espaciado interno */
    font-size: 1em; /* Tamaño de fuente */
    cursor: pointer; /* Cambia el cursor al pasar por encima */
    transition: background-color 0.3s, transform 0.3s; /* Transiciones suaves */
    text-decoration: none; /* Sin subrayado para enlaces */
    flex: 1; /* Para que los botones se distribuyan uniformemente */
    max-width: 200px; /* Ancho máximo para los botones */
}

.dynamic-button:hover {
    background-color: #0056b3; /* Color de fondo al pasar el mouse */
    transform: scale(1.05); /* Aumenta el tamaño al pasar el mouse */
}

.dynamic-button:active {
    transform: scale(0.95); /* Reduce el tamaño al hacer clic */
}
</style>

<div class="container">

    <div class="tabs">
        <a class="tab" href="#contenido1">Cedula </a>
        <a class="tab "href="#contenido2">Programa de trabajo</a>
       
    </div>

    <div id="content">
        <div id="contenido1">
            <x-calendario></x-calendario>
            <div class="button-container">
                <button class="btn btn-primary" onclick="openModal('firstModal')">Abrir Primer Modal</button>

            </div>
        </div>
        <div id="contenido2" class="hidden">
            <div class="column-container">
                <div class="column">
                    <h3>Entrante</h3>
                    <br>
           
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Nombre:</em></strong>
                        {{ 
                            ucwords(
                                strtolower(
                                    $this->auditActivity->handoverDocument->employeeIncoming->first_name . 
                                    (isset($this->auditActivity->handoverDocument->employeeIncoming->second_name) ? ' ' . $this->auditActivity->handoverDocument->employeeIncoming->second_name : '') . 
                                    ' ' . 
                                    $this->auditActivity->handoverDocument->employeeIncoming->first_surname 
                                )
                            ) 
                        }}
                    </p>
                   
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cargo:</em></strong>  <span id="job-title-incoming">{{ $this->auditActivity->handoverDocument->EmployeeIncoming->job_title }}</span>
                    </p>
                    
                 
                 <br>

                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cedula:</em></strong>   
                            {{ preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeIncoming->personal_id) }}
                     </p>
                        <br>
                        <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                            <strong><em style="color: black;">Teléfono:</em></strong>   <span id="formatted-phone-incoming"></span>
                        </p>
                        
                        <script>
                            
                            // Obtén el número de teléfono del backend para el entrante
                            const phoneIncoming = "{{ $this->auditActivity->handoverDocument->EmployeeIncoming->phone }}";
                            
                            // Función para formatear el número de teléfono
                            function formatPhoneNumber(phone) {
                                // Eliminar caracteres no numéricos
                                phone = phone.replace(/\D/g, '');
                        
                                // Verificar que el número tenga al menos 11 dígitos
                                if (phone.length < 11) {
                                    return phone; // Retorna el número sin cambios si es muy corto
                                }
                        
                                // Separar los primeros 4 dígitos
                                const firstPart = phone.substring(0, 4);
                                
                                // Obtener el resto del número
                                const remaining = phone.substring(4);
                        
                                // Combinar las partes
                                return firstPart + '-' + remaining;
                            }
                        
                            // Formatear el número y mostrarlo en el HTML para el entrante
                            document.getElementById('formatted-phone-incoming').innerText = formatPhoneNumber(phoneIncoming);
                        </script>
                        <br>
                        <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                            <strong><em style="color: black;">Correo:</em></strong><span id="email-incoming">{{ $this->auditActivity->handoverDocument->EmployeeIncoming->gmail }}</span>
                        </p>                        
                    
                </div>
                <div class="column">
                    <h3>Saliente</h3>
                    <br>

                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Nombre:</em></strong> 
                        {{ 
                            ucwords(
                                strtolower(
                                    $this->auditActivity->handoverDocument->employeeOutgoing->first_name . 
                                    (isset($this->auditActivity->handoverDocument->employeeOutgoing->second_name) ? ' ' . $this->auditActivity->handoverDocument->employeeOutgoing->second_name : '') . 
                                    ' ' . 
                                    $this->auditActivity->handoverDocument->employeeOutgoing->first_surname 
                                )
                            ) 
                        }}
                    </p>
                   
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cargo:</em></strong>   <span id="job-title-incoming">{{ $this->auditActivity->handoverDocument->employeeOutgoing->job_title }}</span>
                    </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cedula: </em></strong>  
                            {{ preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id) }}
                     </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;"> Teléfono: </em></strong>  <span id="formatted-phone-outgoing"></span>
                    </p>
                     <br>
                     <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Correo:</em></strong> <span id="email-outgoing">{{ $this->auditActivity->handoverDocument->EmployeeOutgoing->gmail }}</span>
                    </p>                 
                 
                    
                    
                    <script>
                        // Obtén el número de teléfono del backend

                         // Obtén el número de teléfono del backend para el saliente
                         const phoneOutgoing = "{{ $this->auditActivity->handoverDocument->EmployeeOutgoing->phone }}";
                                            
                         // Formatear el número y mostrarlo en el HTML para el saliente
                         document.getElementById('formatted-phone-outgoing').innerText = formatPhoneNumber(phoneOutgoing);
                    </script>


                </div>
            </div>
            <div class="button-container">
                <div class="top-buttons">
                    <!-- Botón para programa de trabajo -->
                    <x-button class="dynamic-button" wire:click='programaDocumen'>Programa de trabajo</x-button>
                    
                    <!-- Botón para abrir el requerimiento -->
                    <x-button class="dynamic-button" wire:click='requeriDocumen'>Requerimiento</x-button>
                </div>
                
                <div class="bottom-buttons">
                    <!-- Botón para descargar informe del auditor -->
                    
                    
                    <!-- Formulario para enviar requerimiento por correo -->
                    <form action="{{ url('/enviar-correo-zimbra') }}" method="GET" target="_blank">
                        @csrf <!-- Aunque no es necesario para métodos GET, es una buena práctica incluirlo -->
                        
                        <!-- Campo oculto para enviar el public_id -->
                        <input type="hidden" name="public_id" value="{{ $this->auditActivity->public_id }}">
                        
                        <!-- Campo oculto para enviar el auditActivityId -->
                        <input type="hidden" name="auditActivityId" value="{{ $this->auditActivity->public_id }}">
                        
                        <x-button type="submit" class="dynamic-button">Enviar Requerimiento</x-button>
                    </form>
                </div>
            </div>
            <h1>Subir Documento</h1>

            @if(session('success'))
                <div style="color: green;">
                    {{ session('success') }}
                </div>
            @endif
        
            <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit">Subir</button>
            </form>
        

<script>
    document.querySelectorAll('.dynamic-button').forEach(button => {
    button.addEventListener('click', function() {
        const downloadButton = document.querySelector('button.btn-primary');
        downloadButton.style.display = 'block'; // Muestra el botón al hacer clic
    });
});
    // Mostrar el contenido correspondiente al cargar la página
    window.onload = function() {
        const hash = window.location.hash || '#contenido1'; // Cargar por defecto el contenido 1
        changeContent(hash);
    };

    // Cambiar el contenido al hacer clic en las pestañas
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar el comportamiento por defecto del enlace
            const targetId = this.getAttribute('href');
            changeContent(targetId);
        });
    });

    function changeContent(targetId) {
        // Ocultar todos los contenidos
        document.querySelectorAll('#content > div').forEach(div => {
            div.classList.add('hidden');
        });
        // Mostrar el contenido correspondiente
        const activeDiv = document.querySelector(targetId);
        if (activeDiv) {
            activeDiv.classList.remove('hidden');
        }

        // Marcar la pestaña activa
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active');
        });
        const activeTab = document.querySelector(`.tab[href="${targetId}"]`);
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }
</script>
