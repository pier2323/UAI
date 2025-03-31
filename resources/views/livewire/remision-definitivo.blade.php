<div x-data="remisionTable()" class="p-6 bg-gray-50 rounded-lg shadow-md">
    <!-- Notification -->
    <div x-show="notification.visible" x-transition x-cloak 
         class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        <span x-text="notification.message"></span>
    </div>
    <!-- End Notification -->
    <button @click="showTable = !showTable" class="bg-green-600 text-white rounded-lg px-6 py-2 mb-4 transition duration-300 hover:bg-green-500">
        Ver Remisión de los Informes Definitivos 
    </button>

    <div x-show="showTable" x-transition x-cloak>
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Lista de Remisiones de Informes Definitivas</h1>
        <style>
            .break-words {
                word-wrap: break-word;
                white-space: pre-wrap;
            }
            th, td {
                width: 250px; /* Ajusta este valor según tus necesidades */
                text-align: center; /* Centrar el texto */
                vertical-align: middle; /* Centrar el texto verticalmente */
            }
            table {
                border-collapse: collapse; /* Asegurarse de que los bordes se colapsen correctamente */
            }
            .break-words {
                word-wrap: break-word;
                white-space: pre-wrap;
            }
            .custom-table th, .custom-table td {
                min-width: 250px; /* Aumentar el ancho mínimo de las columnas */
                text-align: center; /* Centrar el texto */
                vertical-align: middle; /* Centrar el texto verticalmente */
            }
            table {
                border-collapse: collapse; /* Asegurarse de que los bordes se colapsen correctamente */
            }
            textarea {
                resize: vertical; /* Permitir el cambio de tamaño solo vertical */
                min-height: 80px; /* Aumentar la altura mínima para los inputs */
                width: 100%; /* Hacer que el textarea ocupe todo el ancho de la celda */
                overflow: auto; /* Permitir el scroll si el contenido excede el tamaño */
            }
        </style>

        <input 
            type="text" 
            x-model="search" 
            placeholder="Buscar por Código" 
            class="border rounded-lg p-3 mb-4 w-1/3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white shadow-lg rounded-lg overflow-hidden" style="table-layout: fixed; width: 150%;">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1 text-left text-sm">Código</th>
                        <th class="border px-2 py-1 text-left text-sm">Para</th>
                        <th class="border px-2 py-1 text-left text-sm">Objective</th> <!-- Nueva columna para el objective -->
                        <th class="border px-2 py-1 text-left text-sm">Hallazgos</th> <!-- Nueva columna para el hallazgos -->
                        <th class="border px-2 py-1 text-left text-sm">Fecha del Definitivo</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    <template x-for="remision in paginatedRemisiones()" :key="remision.id">
                        <tr @dblclick="openMenu($event, remision)" x-data="{ selected: false }" class="hover:bg-gray-100 transition duration-200">
                            <td class="border px-2 py-1 text-sm break-words" x-text="remision.codigo"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="remision.para"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="remision.objective"></td> <!-- Mostrar el objective -->
                            <td class="border px-2 py-1 text-sm break-words" x-text="remision.hallazgos"></td> <!-- Mostrar el hallazgos -->
                            <td class="border px-2 py-1 text-sm break-words" x-text="remision.fecha_definitivo"></td> <!-- Display the date -->
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between">
            <button @click="prevPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === 1">Anterior</button>
            <span class="mx-2 text-gray-700">Página <span x-text="currentPage"></span></span>
            <button @click="nextPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === totalPages">Siguiente</button>
        </div>

        <div x-show="menuVisible" x-transition x-cloak class="absolute bg-white border border-gray-300 rounded-lg shadow-lg p-2" 
            x-ref="menu" 
            x-bind:style="{ top: menuY + 'px', left: menuX + 'px' }" 
            @click.away="menuVisible = false">
            <button @click="downloadTemplate(selectedRemision)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Descargar Memo</button>
            <button @click="editRemision(selectedRemision)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Editar Memo</button>
            <button @click="showDeleteModal = true" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Eliminar Memo</button>
        </div>

        <!-- Modal de confirmación -->
        <div x-show="showDeleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
            <div class="bg-white rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">¿Seguro que quieres eliminar?</h2>
                <div class="flex justify-end">
                    <button @click="showDeleteModal = false" class="bg-gray-600 text-white rounded-lg px-4 py-2 mr-2">No</button>
                    <button @click="deleteRow()" class="bg-red-600 text-white rounded-lg px-4 py-2">Sí</button>
                </div>
            </div>
        </div>

        <!-- Formulario de edición -->
        <div x-show="editingMemo" x-transition class="mt-4 p-4 border border-gray-300 rounded-lg bg-white overflow-x-auto" x-cloak>
            <h2 class="text-lg font-bold mb-2">Editar Memo</h2>
            <table class="min-w-full custom-table">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Código</th>
                        <th class="border px-2 py-1">Para</th>
                        <th class="border px-2 py-1">Objective</th>
                        <th class="border px-2 py-1">Hallazgos</th>
                        <th class="border px-2 py-1">Fecha del Definitivo</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-2 py-1"><textarea x-model="selectedRemision.codigo" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedRemision.para" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedRemision.objective" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedRemision.hallazgos" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1">
                            <input type="date" x-model="selectedRemision.fecha_definitivo" class="border rounded-lg p-1 w-full" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <button @click="saveEditedRemision(selectedRemision)" :disabled="errorMessage !== ''" class="bg-blue-600 text-white rounded-lg px-4 py-2">Guardar Cambios</button>
            <button @click="cancelEdit()" class="bg-red-600 text-white rounded-lg px-4 py-2 ml-2">Cancelar</button>
        </div>
    </div>


    <script>
        function remisionTable() {
            return {
                showTable: false,
                search: '',
                searchPara: '',
                remisiones: @json(App\Models\RemisionDefinitivo::all()),
                currentPage: 1,
                perPage: 15,
                menuVisible: false,
                menuX: 0,
                menuY: 0,
                selectedRemision: null,
                showDeleteModal: false,
                editingMemo: false,
                errorMessage: '',
                notification: {
                    visible: false,
                    message: ''
                },

                get totalPages() {
                    return Math.ceil(this.filteredRemisiones().length / this.perPage);
                },

                filteredRemisiones() {
                    return this.remisiones.filter(remision => {
                        return String(remision.codigo).toLowerCase().includes(this.search.toLowerCase()) &&
                               String(remision.para).toLowerCase().includes(this.searchPara.toLowerCase());
                    });
                },

                paginatedRemisiones() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredRemisiones().slice(start, start + this.perPage);
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },

                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },

                openMenu(event, remision) {
                    this.selectedRemision = remision;
                    this.menuX = event.pageX;
                    this.menuY = event.pageY;
                    this.menuVisible = true;
                },

                downloadTemplate(remision) {
    window.location.href = `/remision-definitivo/download/${remision.id}`;
    this.menuVisible = false;
},

                editRemision(remision) {
                    this.editingMemo = true;
                    this.menuVisible = false;
                    this.selectedRemision = remision;
                },

              saveEditedRemision(remision) {
    fetch(`/remision-definitivo/update/${remision.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(remision) // Convertir el objeto remision a JSON
    })
    .then(response => response.json()) // Procesar la respuesta JSON
    .then(data => {
        if (data.success) {
            this.editingMemo = false; // Cerrar el modo de edición
            this.selectedRemision = null; // Limpiar la remisión seleccionada
            this.showNotification('Memo guardado exitosamente', 'success'); // Mostrar notificación de éxito
        }
    })
    .catch(error => {
        console.error('Error:', error); // Manejar errores
    });
},

                cancelEdit() {
                    this.editingMemo = false;
                    this.selectedRemision = null;
                },

                deleteRow() {
                    fetch(`{{ route('remision-definitivo.destroy', '') }}/${this.selectedRemision.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.remisiones = this.remisiones.filter(remision => remision.id !== this.selectedRemision.id);
                            this.showDeleteModal = false;
                            this.showNotification('Remisión eliminada exitosamente');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },
                showNotification(message) {
                    this.notification.message = message;
                    this.notification.visible = true;
                    setTimeout(() => {
                        this.notification.visible = false;
                    }, 3000); // Hide after 3 seconds
                }
            }
        }

        function fetchObjective(codigo) {
            if (codigo.length === 3) {
                fetch(`/api/audit-activity/${codigo}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('textarea[name="objective"]').value = data.objective || 'No encontrado';
                    })
                    .catch(error => {
                        console.error('Error fetching objective:', error);
                        document.querySelector('textarea[name="objective"]').value = 'Error';
                    });
            } else {
                document.querySelector('textarea[name="objective"]').value = '';
            }
        }
    </script>
</div>
