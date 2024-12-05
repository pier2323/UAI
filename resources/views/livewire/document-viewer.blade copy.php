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
                            <img src="/images/iconos/pdf.png" alt="Ícono de PDF" class="file-icon" />
                        @elseif(str_ends_with($file->name, '.doc') || str_ends_with($file->name, '.docx'))
                            <img src="/images/iconos/word.png" alt="Ícono de Word" class="file-icon" />
                        @elseif(str_ends_with($file->name, '.xls') || str_ends_with($file->name, '.xlsx'))
                            <img src="/images/iconos/excel.png" alt="Ícono de Excel" class="file-icon" />
                        @else
                            <img src="ruta/a/tu/icono-generico.png" alt="Ícono genérico" class="file-icon" />
                        @endif
                    </td>
                    <td>{{ $file->name }}</td>
                    <td>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="view-button" onclick="openModal('{{ Storage::url($file->path) }}')">
                            Ver
                        </button>
                        <a href="{{ Storage::url($file->path) }}" download class="view-button">Descargar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal -->
    <div id="documentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h5 id="modalTitle">Ver Documento</h5>
            <iframe id="documentFrame" src="" width="100%" height="500px"></iframe>
        </div>
    </div>

    <style>
        .document-viewer {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .document-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .document-table th, .document-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .document-table th {
            background-color: #007bff;
            color: white;
        }

        .document-table tr:hover {
            background-color: #f1f1f1;
        }

        .file-icon {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }

        .view-button {
            display: inline-block;
            padding: 5px 8px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 12px;
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
        }

        .view-button:hover {
            background-color: #0056b3;
        }

        /* Estilos del modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Posición fija */
            z-index: 1000; /* Encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%; /* Ancho completo */
            height: 100%; /* Alto completo */
            overflow: auto; /* Habilitar desplazamiento si es necesario */
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Centrar el modal */
            padding: 20px;
            border: 1px solid #888; /* Bordes del modal */
            width: 80%; /* Ancho del modal */
            max-width: 800px; /* Ancho máximo del modal */
            border-radius: 8px; /* Bordes redondeados */
        }

        .close {
            color: #aaa; /* Color del botón de cerrar */
            float: right; /* Alinear a la derecha */
            font-size: 28px; /* Tamaño de la fuente */
            font-weight: bold; /* Negrita */
        }

        .close:hover,
        .close:focus {
            color: black; /* Cambia el color al pasar el mouse */
            text-decoration: none; /* Sin subrayado */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
        }
    </style>

    <script>
        // Función para abrir el modal y cargar el documento
        function openModal(url) {
            document.getElementById('documentFrame').src = url; // Establecer el src del iframe
            document.getElementById('documentModal').style.display = 'block'; // Mostrar el modal
        }

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById('documentModal').style.display = 'none'; // Ocultar el modal
            document.getElementById('documentFrame').src = ''; // Limpiar el src del iframe
        }

        // Cerrar el modal si se hace clic fuera del contenido del modal
        window.onclick = function(event) {
            const modal = document.getElementById('documentModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</div>