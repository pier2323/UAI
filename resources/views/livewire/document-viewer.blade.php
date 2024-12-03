<div class="document-viewer">
    <h1 class="text-center">Documentos Subidos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($files->isEmpty())
        <p class="text-center">No hay documentos subidos para esta actividad.</p>
    @else
        <table class="document-table">
            <thead>
                <tr>
                    <th>Icono</th>
                    <th>Nombre del Documento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <td>
                        @if(str_ends_with($file->name, '.pdf'))
                            <img src="/images/iconos/pdf.png" alt="Ícono de PDF" class="document-icon" />
                        @elseif(str_ends_with($file->name, '.doc') || str_ends_with($file->name, '.docx'))
                            <img src="/images/iconos/word.png" alt="Ícono de Word" class="document-icon" />
                        @elseif(str_ends_with($file->name, '.xls') || str_ends_with($file->name, '.xlsx'))
                            <img src="/images/iconos/excel.png" alt="Ícono de Excel" class="document-icon" />
                        @else
                            <img src="ruta/a/tu/icono-generico.png" alt="Ícono genérico" class="document-icon" />
                        @endif
                    </td>
                    <td>{{ $file->name }}</td>
                    <td>
                        <div class="button-group">
                            <a href="{{ Storage::url($file->path) }}" download onclick="showMessage('Documento descargado');" class="btn btn-success btn-sm" style="margin-left: 4px;">
                                Descargar
                            </a>
                            <form action="{{ route('documents.destroy', $file->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?');" class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
  
        
        <div class="text-center mt-3">
            <hr>
            <div class="d-flex justify-content-center">
                <button wire:click="downloadZip" onclick="showMessage('Documento ZIP descargado');" class="btn-zip mt-2">
                    <img src="/images/iconos/rar.png" alt="Descargar ZIP" class="zip-icon" /> 
                    <span class="ml-2">Descarga (Zip)</span>
                </button>
            </div>
        </div>

        <!-- Mensaje de descarga -->
        <div id="download-message" class="message" style="display: none;"></div>


        <script>
         function showMessage(message) {
        const messageContainer = document.getElementById('download-message');
        messageContainer.textContent = message;
        messageContainer.style.display = 'block';
        messageContainer.classList.add('fade-in');

        // Ocultar el mensaje después de 6 segundos
        setTimeout(() => {
            messageContainer.classList.remove('fade-in');
            messageContainer.classList.add('fade-out');
            // Esperar a que termine la animación antes de ocultar el mensaje completamente
            setTimeout(() => {
                messageContainer.style.display = 'none';
                messageContainer.classList.remove('fade-out');
            }, 500); // Tiempo de la animación
        }, 6000); // Tiempo de espera antes de comenzar la animación de salida
    }

    // Agregar evento para mostrar mensaje de eliminación exitosa
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="documents.destroy"]');
        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('Documento eliminado');
                    } else {
                        showMessage('Error al eliminar el documento');
                    }
                })
                .catch(error => {
                    console.error(error);
                    showMessage('Error al eliminar el documento');
                });
            });
        });
    });
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
            .btn-zip {
    background-color: #007bff; /* Color de fondo del botón ZIP */
    color: white; /* Color del texto en el botón ZIP */
    padding: 8px 16px; /* Ajustar el padding para el tamaño del botón */
    border: none; /* Sin borde */
    border-radius: 4px; /* Bordes redondeados */
    font-size: 14px; /* Tamaño de fuente */
    display: flex; /* Usar flexbox para alinear el icono y el texto */
    align-items: center; /* Centrar verticalmente el contenido */
    transition: background-color 0.3s, transform 0.3s; /* Añadir transición */
}

.btn-zip:hover {
    background-color: #0056b3; /* Color de fondo al hacer hover para el botón ZIP */
    transform: scale(1.05); /* Efecto de aumento al hacer hover */
}

.zip-icon {
    width: 20px; /* Ajustar el tamaño del ícono ZIP */
    height: 20px; /* Ajustar el tamaño del ícono ZIP */
    margin-right: 5px; /* Espacio entre el icono y el texto */
}
            .button-group {
                display: flex; /* Usar flexbox para alinear los botones verticalmente */
                flex-direction: column; /* Alinear los botones en una columna */
                width: 120px; /* Ancho fijo para el contenedor */
            }

            .btn {
                width: 100%; /* Hacer que ambos botones ocupen el 100% del ancho del contenedor */
                margin-bottom: 10px; /* Espacio entre los botones */
            }

            .btn:last-child {
                margin-bottom: 0; /* Eliminar el margen inferior del último botón */
            }

            .btn-success {
                background-color: #28a745; /* Color de fondo del botón verde */
                color: white; /* Color del texto en el botón verde */
            }

            .btn-success:hover {
                background-color: #218838; /* Color de fondo al hacer hover para el botón verde */
                transform: scale(1.05); /* Efecto de aumento al hacer hover */
            }

            .btn-danger {
                background-color: #dc3545; /* Color de fondo del botón rojo */
                color: white; /* Color del
                                color: white; /* Color del texto en el botón rojo */
            }

.btn-danger:hover {
    background-color: #c82333; /* Color de fondo al hacer hover para el botón rojo */
    transform: scale(1.05); /* Efecto de aumento al hacer hover */
}

.document-table {
    width: 100%;
    border-collapse: collapse;
}

.document-table th, .document-table td {
    padding: 10px;
    text-align: left;
    vertical-align: middle;
}

.document-icon {
    width: 35px;
    height: 35px;
    margin-right: 10px;
    vertical-align: middle;
}

.zip-icon {
    width: 25px; /* Ajustar el tamaño del ícono ZIP */
    height: 25px; /* Ajustar el tamaño del ícono ZIP */
    vertical-align: middle;
}

.btn {
    display: flex;
    align-items: center;
    padding: 10px 20px; /* Ajustar el padding para el tamaño del botón */
    transition: background-color 0.3s, transform 0.3s; /* Añadir transición */
}

.btn-primary {
    background-color: #007bff; /* Color de fondo del botón primario */
    color: white; /* Color del texto en el botón primario */
}

.btn-primary:hover {
    background-color: #0056b3; /* Color de fondo al hacer hover para el botón primario */
    transform: scale(1.05); /* Efecto de aumento al hacer hover */
}

hr {
    margin: 20px 0; /* Espaciado vertical de la línea divisoria */
    border: 1px solid #ccc; /* Color y estilo de la línea divisoria */
}
</style>
@endif
</div>