<div x-data="memoTable()" class="p-6 bg-gray-50 rounded-lg shadow-md">
    <button @click="showTable = !showTable" class="bg-green-600 text-white rounded-lg px-6 py-2 mb-4 transition duration-300 hover:bg-green-500">
        Ver lista de Memos
    </button>

    <div x-show="showTable" x-transition>
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Lista de Memos</h1>

        <input 
            type="text" 
            x-model="search" 
            placeholder="Buscar por Código" 
            class="border rounded-lg p-3 mb-4 w-1/3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <!-- Contenedor para el scroll horizontal -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white shadow-lg rounded-lg overflow-hidden" style="table-layout: fixed; width: 150%;">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1 text-left text-sm">Descripción</th>
                        <th class="border px-2 py-1 text-left text-sm">Tipo Memo</th>
                        <th class="border px-4 py-1 text-left text-sm">Código</th>
                        <th class="border px-4 py-1 text-left text-sm">Para</th>
                        <th class="border px-2 py-1 text-left text-sm">Gerencia</th>
                        <th class="border px-2 py-1 text-left text-sm">Fechas</th>
                        <th class="border px-2 py-1 text-sm">Conclusión</th>
                        <th class="border px-2 py-1 text-sm">Recomendaciones</th>
                        <th class="border px-2 py-1 text-left text-sm">Auditoría/Nº Hallazgo</th>
                        <th class="border px-2 py-1 text-left text-sm">Riesgo</th>
                        <th class="border px-2 py-1 text-left text-sm">Unidad Responsable</th>
                        <th class="border px-2 py-1 text-left text-sm">Transferido a</th>
                        <th class="border px-2 py-1 text-left text-sm">Reporte trimestral / Semestral</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="memo in paginatedMemos()" :key="memo.id">
                        <tr @dblclick="openMenu($event, memo)" x-data="{ selected: false }" class="hover:bg-gray-100 transition duration-200">
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.descripcion"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.tipo_hallazgo"></td>
                            <td class="border px-4 py-1 text-sm break-words" x-text="memo.input_tipo1"></td>
                            <td class="border px-4 py-1 text-sm break-words" x-text="memo.par"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.gerencia"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="formatDate(memo.fecha1) + ' al ' + formatDate(memo.fecha2)"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.conclusion"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.recomendaciones"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.auditoria"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.riesgo"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.unidad_responsable"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.transferido_a"></td>
                            <td class="border px-2 py-1 text-sm break-words" x-text="memo.fechas_reporte"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        
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
th, td {
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

        <!-- Paginación -->
        <div class="mt-4 flex items-center justify-between">
            <button @click="prevPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === 1">Anterior</button>
            <span class="mx-2 text-gray-700">Página <span x-text="currentPage"></span></span>
            <button @click="nextPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === totalPages">Siguiente</button>
        </div>

        <!-- Menú de opciones -->
        <div x-show="menuVisible" x-transition x-cloak class="absolute bg-white border border-gray-300 rounded-lg shadow-lg p-2" 
             x-ref="menu" 
             x-bind:style="{ top: menuY + 'px', left: menuX + 'px' }" 
             @click.away="menuVisible = false">
             <button @click="option1(selectedMemo)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Descargar Memo</button>
             <button @click="editMemo(selectedMemo)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Editar Memo</button>
         </div>

         <div x-show="editingMemo" x-transition class="mt-4 p-4 border border-gray-300 rounded-lg bg-white overflow-x-auto">
            <h2 class="text-lg font-bold mb-2">Editar Memo</h2>
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Descripción</th>
                        <th class="border px-2 py-1">Tipo Memo</th>
                        <th class="border px-2 py-1">Código</th>
                        <th class="border px-2 py-1">Para</th>
                        <th class="border px-2 py-1">Gerencia</th>
                        <th class="border px-2 py-1">Fechas</th>
                        <th class="border px-2 py-1">Conclusión</th>
                        <th class="border px-2 py-1">Recomendaciones</th>
                        <th class="border px-2 py-1">Auditoría/Nº Hallazgo</th>
                        <th class="border px-2 py-1">Riesgo</th>
                        <th class="border px-2 py-1">Unidad Responsable</th>
                        <th class="border px-2 py-1">Transferido a</th>
                        <th class="border px-2 py-1">Reporte trimestral / Semestral</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.descripcion" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.tipo_hallazgo" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.input_tipo1" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.par" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.gerencia" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.fecha1" placeholder="Fecha 1" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.conclusion" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.recomendaciones" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.auditoria" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.riesgo" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.unidad_responsable" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.transferido_a" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.fechas_reporte" class="border rounded-lg p-1"></textarea></td>
                    </tr>
                </tbody>
            </table>
            <button @click="saveEditedMemo(selectedMemo)" class="bg-blue-600 text-white rounded-lg px-4 py-2">Guardar Cambios</button>
        </div>
 <script>
  function memoTable() {
    return {
        showTable: false,
        search: '',
        memos: @json(App\Models\Memo::all()),
        currentPage: 1,
        perPage: 15,
        menuVisible: false,
        editingMemo: false,
        menuX: 0,
        menuY: 0,
        selectedMemo: null,

        get totalPages() {
            return Math.ceil(this.filteredMemos().length / this.perPage);
        },

        filteredMemos() {
            if (this.search === '') {
                return this.memos;
            }
            return this.memos.filter(memo => {
                return String(memo.input_tipo1).toLowerCase().includes(this.search.toLowerCase());
            });
        },

        paginatedMemos() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredMemos().slice(start, start + this.perPage);
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

        openMenu(event, memo) {
            this.selectedMemo = memo; // Guardar el memo seleccionado
            this.menuX = event.pageX; // Obtener la posición X del clic
            this.menuY = event.pageY; // Obtener la posición Y del clic
            this.menuVisible = true; // Mostrar el menú
        },

        editMemo(memo) {
            this.editingMemo = true; // Activar el modo de edición
            this.menuVisible = false; // Ocultar el menú
        },

        saveEditedMemo(memo) {
    fetch(`/actualizar-memo/${memo.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(memo)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            this.editingMemo = false; // Ocultar el área de edición
            this.selectedMemo = null; // Limpiar el memo seleccionado
            this.showTable = false; // Ocultar la tabla
            this.showTable = true; // Volver a mostrar la tabla para reflejar los cambios
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
},

formatDate(dateString) {
                    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
                    const date = new Date(dateString + 'T00:00:00');
                    return date.toLocaleDateString('es-ES', options);
                }
            }
        }
 </script>