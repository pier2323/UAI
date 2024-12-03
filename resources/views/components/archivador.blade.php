<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@php
    // Formatear el número de teléfono
$phoneIncoming = $this->auditActivity->handoverDocument->EmployeeIncoming->phone;
$formattedPhoneIncoming = substr($phoneIncoming, 0, 4) . '-' . substr($phoneIncoming, 4);

$phoneOutgoing = $this->auditActivity->handoverDocument->EmployeeOutgoing->phone;
$formattedPhoneOutgoing = substr($phoneOutgoing, 0, 4) . '-' . substr($phoneOutgoing, 4);
@endphp
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

.bottom-buttons {
    display: flex; /* Usar flexbox para alinear los botones en una fila */
    justify-content: center; /* Centrar horizontalmente */
    align-items: center; /* Alinear verticalmente si es necesario */
    margin-top: 20px; /* Margen superior para separación del contenedor */
}
.dynamic-button {
    margin: 0 auto; /* Márgenes automáticos para centrar */
    display: block; /* Asegúrate de que el botón sea un bloque */
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
.btn-upload {
    background-color: #4CAF50; /* Color de fondo verde */
    color: white; /* Color del texto */
    padding: 10px 20px; /* Espaciado interno */
    border: none; /* Sin borde */
    border-radius: 5px; /* Bordes redondeados */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
    font-size: 16px; /* Tamaño de fuente */
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

.btn-upload:hover {
    background-color: #45a049; /* Color de fondo al pasar el mouse */
}

.divider {
    margin: 20px 0; /* Margen superior e inferior */
    height: 2px; /* Altura del divisor */
    background-color: #ccc; /* Color del divisor */
    width: 100%; /* Ancho completo */
}
.btn-select {
    background-color: #007BFF; /* Color de fondo azul */
    color: white; /* Color del texto */
    padding: 10px 20px; /* Espaciado interno */
    border: none; /* Sin borde */
    border-radius: 5px; /* Bordes redondeados */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
    font-size: 16px; /* Tamaño de fuente */
    display: inline-block; /* Para que el botón se comporte como un botón */
    margin-right: 10px; /* Espacio entre los botones */
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

.btn-select:hover {
    background-color: #0056b3; /* Color de fondo al pasar el mouse */
}

.btn-upload {
    background-color: #4CAF50; /* Color de fondo verde */
    color: white; /* Color del texto */
    padding: 10px 20px; /* Espaciado interno */
    border: none; /* Sin borde */
    border-radius: 5px; /* Bordes redondeados */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
    font-size: 16px; /* Tamaño de fuente */
    transition: background-color 0.3s; /* Transición suave para el color de fondo */
}

.btn-upload:hover {
    background-color: #45a049; /* Color de fondo al pasar el mouse */
}

.divider {
    margin: 20px 0; /* Margen superior e inferior */
    height: 2px; /* Altura del divisor */
    background-color: #ccc; /* Color del divisor */
    width: 100%; /* Ancho completo */
}
.modal {
    display: none; /* Oculto por defecto */
    position: fixed; /* Fijo */
    z-index: 1; /* En la parte superior */
    left: 0;
    top: 0;
    width: 100%; /* Ancho completo */
    height: 100%; /* Altura completa */
    overflow: auto; /* Habilitar scroll si es necesario */
    background-color: rgb(0,0,0); /* Color de fondo */
    background-color: rgba(0,0,0,0.4); /* Fondo negro con opacidad */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% desde la parte superior y centrado */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Ancho */
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
.modal-content button {
    margin: 5px;
    padding: 10px 15px;
    cursor: pointer;
}
.name-container {
    max-width: 300px; /* Ajusta este valor según sea necesario */
    overflow-wrap: break-word; /* Permite que las palabras se dividan si son demasiado largas */
    word-wrap: break-word; /* Para compatibilidad con navegadores más antiguos */
    word-break: break-all; /* Rompe la palabra si es necesario */
}
.email-container {
    max-width: 300px; /* Ajusta este valor según sea necesario */
    overflow-wrap: break-word; /* Permite que las palabras se dividan si son demasiado largas */
    word-wrap: break-word; /* Para compatibilidad con navegadores más antiguos */
    word-break: break-all; /* Rompe la palabra si es necesario */
}
.btn {
    padding: 5px 10px; /* Reduce el padding para hacer el botón más pequeño */
    font-size: 14px; /* Ajusta el tamaño de la fuente */
    text-align: center; /* Asegura que el texto esté centrado */
}
</style>

<div class="container">

    <div class="tabs">
        <a class="tab" href="#contenido1">Programa de trabajo</a>
        <a class="tab" href="#contenido2">Cédula</a>
        <a class="tab" href="#contenido3">Descarga Documento</a> <!-- Nueva pestaña -->
    </div>

    <div id="content">
        <div id="contenido2">
            <x-calendario></x-calendario>
            <div class="button-container">
                <button class="btn btn-primary" onclick="openModal('firstModal')">Revicion de Cedula</button>
            </div>
        </div>
        <div id="contenido1" class="hidden">
            <div class="column-container">
                <div class="column">
                    <h3>Entrante</h3>
                    <br>
        
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Nombre:</em></strong>
                        <span class="name-container" id="formatted-name-incoming">
                            {{$this->auditActivity->handoverDocument->employeeIncoming->first_name . 
                            (isset($this->auditActivity->handoverDocument->employeeIncoming->second_name) ? ' ' . $this->auditActivity->handoverDocument->employeeIncoming->second_name : '') . 
                            ' ' . 
                            $this->auditActivity->handoverDocument->employeeIncoming->first_surname }}
                        </span>
                    </p>
        
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cargo:</em></strong>  
                        <span id="job-title-incoming">{{ $this->auditActivity->handoverDocument->EmployeeIncoming->job_title }}</span>
                    </p>
        
                    <br>
        
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cedula:</em></strong>   
                        {{ preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeIncoming->personal_id) }}
                    </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Teléfono:</em></strong>   
                        <span id="formatted-phone-incoming">{{ $formattedPhoneIncoming }}</span>
                    </p>
                  
        
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Correo:</em></strong>
                        <span class="email-container" id="email-incoming">{{ $this->auditActivity->handoverDocument->EmployeeIncoming->gmail }}</span>
                    </p>                        
                </div>
        
                <div class="column">
                    <h3>Saliente</h3>
                    <br>
        
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Nombre:</em></strong> 
                        <span class="name-container" id="formatted-name-outgoing">
                            {{ $this->auditActivity->handoverDocument->employeeOutgoing->first_name . 
                            (isset($this->auditActivity->handoverDocument->employeeOutgoing->second_name) ? ' ' . $this->auditActivity->handoverDocument->employeeOutgoing->second_name : '') . 
                            ' ' . 
                            $this->auditActivity->handoverDocument->employeeOutgoing->first_surname }}
                        </span>
                    </p>

                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cargo:</em></strong>   
                        <span id="job-title-outgoing">{{ $this->auditActivity->handoverDocument->employeeOutgoing->job_title }}</span>
                    </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Cedula:</em></strong>  
                        {{ preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id) }}
                    </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Teléfono:</em></strong>  
                        <span id="formatted-phone-outgoing">{{ $formattedPhoneOutgoing }}</span>
                    </p>
                    <br>
                    <p class="text-gray-600" style="font-size: 0.9em; margin: 0; padding: 0; text-align: left;">
                        <strong><em style="color: black;">Correo:</em></strong> 
                        <span class="email-container" id="email-outgoing">{{ $this->auditActivity->handoverDocument->EmployeeOutgoing->gmail }}</span>
                    </p>            
        
                   
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
        </div>
        <div id="contenido3" class="hidden"> <!-- Nuevo contenedor para "Descarga Documento" -->
       
            <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <input type="hidden" name="auditActivityId" value="{{ $this->auditActivity->public_id }}">
        
                <!-- Input de archivo oculto -->
                <input type="file" name="file" id="file-input" required style="display: none;" onchange="fileSelected()">
        
                <!-- Botón personalizado para seleccionar archivo -->
                <label for="file-input" class="btn-select">Seleccionar Archivo</label>
                <span id="file-name" style="margin-left: 10px; font-weight: bold;"></span>
        
                <!-- Botón de Subir Documento -->
                <button type="submit" class="btn-upload">Subir Documento</button>
            </form>
        
           
        
            <!-- Mensaje de archivo subido -->
            <div id="upload-message" class="message" style="display: none;"></div>
        
            <!-- Divisor -->
            <div class="divider"></div>
        
            @livewire('document-viewer', ['auditActivityId' => $this->auditActivity->public_id])

            <!-- Botón Definitivo -->
<button class="btn btn-primary" id="btn-definitivo">Definitivo</button>

<div id="check-message" class="message" style="display: none;"></div>

<div class="button-container">
    <button class="btn btn-primary" id="btn-generar-definitivo" value="{{ $this->auditActivity->public_id }}">
        Generar Definitivo
    </button>
</div>

<script>
    document.getElementById('btn-generar-definitivo').addEventListener('click', function() {
        const publicId = this.value; // Obtener el public_id del botón
        window.location.href = `{{ route('ruta.union') }}?auditActivityId=${publicId}`; // Cambia 'ruta.union' por el nombre de tu ruta
    });
</script>

<div class="button-container">
    <button class="btn btn-primary" id="btn-generar-conclusion" value="{{ $this->auditActivity->public_id }}">Generar Conclusión y Recomendación</button>
</div>


<!-- Modal para preguntar si tiene CECO -->
<div id="cecoModal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-ceco-modal">&times;</span>
        <h2>¿Tiene CECO?</h2>
        <button id="btn-ceco-si">Sí</button>
        <button id="btn-ceco-no">No</button>
    </div>
</div>  

<script>
// Mostrar el modal al hacer clic en "Generar Conclusión y Recomendación"
document.getElementById('btn-generar-conclusion').addEventListener('click', function() {
    document.getElementById('cecoModal').style.display = 'block';
});

// Cerrar el modal
document.getElementById('close-ceco-modal').addEventListener('click', function() {
    document.getElementById('cecoModal').style.display = 'none';
});

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('cecoModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

// Manejar la respuesta "Sí"
document.getElementById('btn-ceco-si').addEventListener('click', function() {
    document.getElementById('cecoModal').style.display = 'none';
    
    // Obtener el public_id del botón
    const publicId = document.getElementById('btn-generar-conclusion').value;
    
    // Redireccionar a la ruta con el public_id
    window.location.href = `{{ route('documento.ceco') }}?auditActivityId=${publicId}`;
});

// Manejar la respuesta "No"
document.getElementById('btn-ceco-no').addEventListener('click', function() {
    document.getElementById('cecoModal').style.display = 'none';
    
    // Obtener el public_id del botón
    const publicId = document.getElementById('btn-generar-conclusion').value;
    
    // Redireccionar a la ruta con el public_id
    window.location.href = `{{ route('documento.no.ceco') }}?auditActivityId=${publicId}`;
});
</script>




        </div>
        
        <script>
  document.getElementById('btn-definitivo').addEventListener('click', function() {
    const auditActivityId = "{{ $this->auditActivity->public_id }}"; // Obtener el ID de la actividad
    const url = "{{ route('documents.check') }}"; // Ruta para verificar el documento

    // Hacer una solicitud POST al controlador
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Incluir el token CSRF
        },
        body: JSON.stringify({ auditActivityId: auditActivityId })
    })
    .then(response => {
        return response.json().then(data => {
            // Mostrar el mensaje en función de la respuesta
            const messageDiv = document.getElementById('check-message');
            messageDiv.style.display = 'block';
            messageDiv.textContent = data.message;
            messageDiv.classList.add('fade-in');

            // Mostrar el modal si el documento existe
            if (response.ok) { // Verifica si la respuesta fue exitosa (status 200)
                document.getElementById('modal-message').textContent = data.message; // Mensaje del modal
                document.getElementById('myModal').style.display = 'block'; // Mostrar el modal
            }

            // Ocultar el mensaje después de 6 segundos
            setTimeout(() => {
                messageDiv.classList.remove('fade-in');
                messageDiv.classList.add('fade-out');
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                    messageDiv.classList.remove('fade-out');
                }, 500);
            }, 6000);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Cerrar el modal
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('myModal').style.display = 'none';
});

// Cerrar el modal si se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
        </script>
        
        <style>
            .message {
                position: fixed; /* Fijo en la pantalla */
                left: 20px; /* A la izquierda */
                bottom: 20px; /* Espacio desde la parte inferior */
                background-color: #4CAF50; /* Color de fondo */
                color: white; /* Color del texto */
                padding: 10px 20px; /* Espaciado interno */
                border-radius: 5px; /* Bordes redondeados */
                transition: opacity 0.5s ease, transform 0.5s ease; /* Transiciones para la animación */
                opacity: 0; /* Inicialmente invisible */
                transform: translateY(20px); /* Mover hacia arriba */
            }
            .fade-in {
        opacity: 1; /* Hacer visible */
        transform: translateY(0); /* Volver a la posición original */
    }

    .fade-out {
        opacity: 0; /* Hacer invisible */
        transform: translateY(-20px); /* Mover hacia arriba */
    }
</style>        
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
