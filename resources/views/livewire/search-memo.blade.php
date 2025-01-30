<div x-data="memoTable()" class="p-6 bg-gray-50 rounded-lg shadow-md">
    <button @click="showTable = !showTable" class="bg-green-600 text-white rounded-lg px-6 py-2 mb-4 transition duration-300 hover:bg-green-500">
        Ver lista de Memos
    </button>

    <div x-show="showTable" x-transition x-cloak>
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Lista de Memos</h1>
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
                            <td class="border px-4 py-1 text-sm break-words" x-text="memo.anio + '-' + memo.input_tipo1"></td>
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

        <div class="mt-4 flex items-center justify-between">
            <button @click="prevPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === 1">Anterior</button>
            <span class="mx-2 text-gray-700">Página <span x-text="currentPage"></span></span>
            <button @click="nextPage()" class="bg-blue-600 text-white rounded-lg px-4 py-2 transition duration-300 hover:bg-blue-500" :disabled="currentPage === totalPages">Siguiente</button>
        </div>

        <div x-show="menuVisible" x-transition x-cloak class="absolute bg-white border border-gray-300 rounded-lg shadow-lg p-2" 
        x-ref="menu" 
        x-bind:style="{ top: menuY + 'px', left: menuX + 'px' }" 
        @click.away="menuVisible = false">
        <button @click="option1(selectedMemo)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Descargar Memo</button>
        <button @click="editMemo(selectedMemo)" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition duration-200">Editar Memo</button>
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
   

         <div x-show="editingMemo" x-transition class="mt-4 p-4 border border-gray-300 rounded-lg bg-white overflow-x-auto" x-cloak>
            <h2 class="text-lg font-bold mb-2">Editar Memo</h2>
            <table class="min-w-full custom-table">
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
                        <td class="border px-2 py-1">
                            <textarea x-model="selectedMemo.tipo_hallazgo" class="border rounded-lg p-1 bg-gray-100" readonly></textarea>
                        </td>
                        <td class="border px-2 py-1">
                            <textarea x-model="selectedMemo.input_tipo1" class="border rounded-lg p-1" maxlength="3" @input="validateNumericInput($event)">
                                <template x-text="selectedMemo.anio + '-' + selectedMemo.input_tipo1"></template>
                            </textarea>
                        </td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.par" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1"><textarea x-model="selectedMemo.gerencia" class="border rounded-lg p-1"></textarea></td>
                        <td class="border px-2 py-1">
                            <textarea x-model="selectedMemo.fechaConcatenada" @input="updateFechas" class="border rounded-lg p-1"></textarea>
                        </td>
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
            <button @click="saveEditedMemo(selectedMemo)" :disabled="errorMessage !== ''" class="bg-blue-600 text-white rounded-lg px-4 py-2">Guardar Cambios</button>
            <button @click="cancelEdit()" class="bg-red-600 text-white rounded-lg px-4 py-2 ml-2">Cancelar</button>
           
        </div>
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
            menuX: 0,
            menuY: 0,
            selectedMemo: null,
            originalMemo: null,
            editingMemo: false,
            successMessage: '',
            cancelMessage: '',
            debounceTimeout: null,
            errorMessage: '',
            showDeleteModal: false,

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
                this.selectedMemo = memo;
                this.menuX = event.pageX;
                this.menuY = event.pageY;
                this.menuVisible = true;
            },

            option1(memo) {
                window.location.href = `/descarga-memo/${memo.input_tipo1}`;
                this.menuVisible = false;
            },

            editMemo(memo) {
                this.editingMemo = true;
                this.menuVisible = false;
                this.originalMemo = JSON.parse(JSON.stringify(memo)); // Guardar una copia del memo original
                this.selectedMemo.fechaConcatenada = `${this.formatDate(memo.fecha1)} al ${this.formatDate(memo.fecha2)}`;
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
                        this.editingMemo = false;
                        this.selectedMemo = null;
                        this.showTable = true;
                        this.cancelMessage = '';
                        this.successMessage = 'Memo guardado exitosamente';
                        this.showNotification(this.successMessage, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            },

            cancelEdit() {
                if (this.originalMemo) {
                    // Restaurar los valores originales
                    Object.assign(this.selectedMemo, this.originalMemo);
                }
                this.editingMemo = false;
                this.successMessage = '';
                this.cancelMessage = 'Edición cancelada';
                this.showNotification(this.cancelMessage, 'error');
            },

            deleteRow() {
                // Lógica para eliminar la fila
                fetch(`/eliminar-memo/${this.selectedMemo.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.memos = this.memos.filter(memo => memo.id !== this.selectedMemo.id);
                        this.showDeleteModal = false;
                        this.showNotification('Memo eliminado exitosamente', 'success');
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
            },

            updateFechas(event) {
                clearTimeout(this.debounceTimeout);
                this.debounceTimeout = setTimeout(() => {
                    const fechas = event.target.value.split(' al ');
                    if (fechas.length === 2) {
                        const fecha1 = this.parseDate(fechas[0]);
                        const fecha2 = this.parseDate(fechas[1]);
                        if (fecha1 && fecha2) {
                            this.selectedMemo.fecha1 = fecha1;
                            this.selectedMemo.fecha2 = fecha2;
                            this.errorMessage = '';
                            this.showNotification('Fechas válidas', 'success');
                        } else {
                            this.errorMessage = 'Fecha no válida. Formato esperado: DD/MM/YYYY';
                            this.showNotification(this.errorMessage, 'error');
                        }
                    } else {
                        this.errorMessage = 'Formato de fecha no válido. Formato esperado: DD/MM/YYYY';
                        this.showNotification(this.errorMessage, 'error');
                    }
                }, 500); // 500ms debounce time
            },

            parseDate(dateString) {
                const [day, month, year] = dateString.split('/');
                if (!day || !month || !year || day > 31 || month > 12 || year.length !== 4) {
                    if (day > 31) {
                        this.errorMessage = 'Día no válido. Formato esperado: DD/MM/YYYY';
                    } else if (month > 12) {
                        this.errorMessage = 'Mes no válido. Formato esperado: DD/MM/YYYY';
                    } else if (year.length !== 4) {
                        this.errorMessage = 'Año no válido. Formato esperado: DD/MM/YYYY';
                    } else {
                        this.errorMessage = 'Fecha no válida. Formato esperado: DD/MM/YYYY';
                    }
                    return null;
                }
                const date = new Date(`${year}-${month}-${day}`);
                if (isNaN(date)) {
                    this.errorMessage = 'Fecha no válida. Formato esperado: DD/MM/YYYY';
                    return null;
                }
                return `${year}-${month}-${day}`;
            },

            showNotification(message, type) {
                // Remove existing notification if any
                const existingNotification = document.querySelector('.notification');
                if (existingNotification) {
                    existingNotification.remove();
                }

                const notification = document.createElement('div');
                notification.className = `notification fixed bottom-4 right-4 text-white rounded-lg px-4 py-2 shadow-lg transition-transform transform translate-y-10 opacity-0 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
                notification.textContent = message;
                document.body.appendChild(notification);

                // Trigger the transition
                requestAnimationFrame(() => {
                    notification.classList.remove('translate-y-10', 'opacity-0');
                    notification.classList.add('translate-y-0', 'opacity-100');
                });

                setTimeout(() => {
                    notification.classList.add('translate-y-10', 'opacity-0');
                    notification.addEventListener('transitionend', () => {
                        notification.remove();
                    }, { once: true });
                }, 3000);
            },

            validateNumericInput(event) {
                const input = event.target;
                input.value = input.value.replace(/[^0-9]/g, '').slice(0, 3);
            }
        }
    }
    </script>
</div>