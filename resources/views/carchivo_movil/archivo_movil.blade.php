<x-app-layout>
    <x-section-basic>
        
        <input type="text" id="search" placeholder="Buscar..." class="mb-4 p-2 border rounded">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Codigo</th>
                    <th class="border border-gray-300 px-4 py-2">Número Archivo</th>
                    <th class="border border-gray-300 px-4 py-2">Año</th>
                    <th class="border border-gray-300 px-4 py-2">Código de la Auditoría</th>
                </tr>
            </thead>
            <tbody id="archivoMovilTable">
                @forelse ($archivoMoviles as $archivoMovil)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $archivoMovil->id ?? '' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $archivoMovil->numero_archivo ?? '' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $archivoMovil->año }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $archivoMovil->codigo_auditoria ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center border border-gray-300 px-4 py-2">No hay datos</td>
                    </tr>
                @endforelse
            </tbody>

        <!-- Add file input for Excel upload -->
        <div class="mb-4">
            <label for="excelFile" class="block mb-2">Subir documento Excel:</label>
            <input type="file" id="excelFile" accept=".xls,.xlsx,.xlsm" class="p-2 border rounded">
            <button id="uploadExcel" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Subir</button>
            <button id="saveData" class="ml-2 px-4 py-2 bg-green-500 text-white rounded" disabled>Guardar</button>
        </div>
        </table>
        <script>
        let extractedData = []; // Store extracted IDs and Numero Archivo

        document.getElementById('search').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#archivoMovilTable tr');
            let hasData = false;
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                const matches = rowText.includes(searchValue);
                
                row.style.display = matches ? '' : 'none';
                if (matches) hasData = true;
            });

            if (!hasData) {
                document.querySelector('#archivoMovilTable').innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center border border-gray-300 px-4 py-2">No hay datos</td>
                        </tr>
                        `;
                    }
                });

                // Función para mostrar mensajes en la parte inferior derecha
                function showToast(message) {
                    const toast = document.createElement('div');
                    toast.textContent = message;
                    toast.style.position = 'fixed';
                    toast.style.bottom = '20px';
                    toast.style.right = '20px';
                    toast.style.backgroundColor = '#4caf50';
                    toast.style.color = 'white';
                    toast.style.padding = '10px 20px';
                    toast.style.borderRadius = '5px';
                    toast.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.3)';
                    toast.style.zIndex = '1000';
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.remove();
                    }, 3000); // El mensaje desaparece después de 3 segundos
                }

                document.getElementById('uploadExcel').addEventListener('click', function () {
                    const fileInput = document.getElementById('excelFile');
                    const file = fileInput.files[0];
                    
                    if (!file) {
                        alert('Por favor, selecciona un archivo.');
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        
                        // Extract data from the first sheet
                        const firstSheetName = workbook.SheetNames[0];
                        const worksheet = workbook.Sheets[firstSheetName];
                        const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });
                        
                        console.log('Datos extraídos del archivo:', jsonData);
                        
                        // Extract IDs from column A, Numero Archivo from column B, Año from column C, Código Auditoría from column D
                        extractedData = jsonData.slice(1).map(row => ({
                            id: row[0], // Column A
                            numero_archivo: row[1], // Column B
                            año: row[2], // Column C
                            codigo_auditoria: row[3] // Column D
                        })).filter(item => item.id); // Skip rows without an ID
                        
                        console.log('Datos extraídos:', extractedData);
                        
                        if (extractedData.length > 0) {
                            document.getElementById('saveData').disabled = false; // Enable "Guardar" button
                            showToast(`Archivo "${file.name}" subido con éxito.`);
                        } else {
                            alert('No se encontraron datos válidos en el archivo.');
                        }
                    };
                    reader.readAsArrayBuffer(file);
                });
                
                document.getElementById('saveData').addEventListener('click', function () {
                    if (extractedData.length === 0) {
                        alert('No hay datos para guardar.');
                        return;
                    }

                    fetch('{{ route('archivo.movil.save') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ data: extractedData })
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error(`Network response was not ok: ${response.statusText}`);
                            location.reload();
                            return;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            localStorage.setItem('successMessage', 'Datos guardados con éxito.');
                            location.reload();
                        } else {
                            console.error('Error en la respuesta del servidor:', data.message);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        location.reload();
                    });
                });

                // Mostrar mensaje al recargar la página si existe
                window.addEventListener('load', function () {
                    const successMessage = localStorage.getItem('successMessage');
                    if (successMessage) {
                        showToast(successMessage);
                        localStorage.removeItem('successMessage'); // Limpiar el mensaje después de mostrarlo
                    }
                });
        </script>

    <!-- Include the SheetJS library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</x-section-basic>
</x-app-layout>