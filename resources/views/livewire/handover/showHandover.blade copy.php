
<div>
    @php
    
  

// Definir los días feriados
$diasFeriados = [
    '2019-12-24', // Navidad
    '2019-12-25', // Navidad
    '2019-12-31', // Fin de Año
    '2020-01-01', // Año Nuevo

    // Días festivos de 2024
    '2024-01-01', // Año Nuevo
    '2024-02-12', // Carnaval
    '2024-02-13', // Carnaval
    '2024-03-28', // Jueves Santo
    '2024-03-29', // Viernes Santo
    '2024-04-19', // Declaración de Independencia
    '2024-05-01', // Día del Trabajador
    '2024-06-24', // Día de la Batalla de Carabobo
    '2024-07-05', // Día de la Independencia
    '2024-07-24', // Natalicio de Simón Bolívar
    '2024-07-28', // Telecomunicador
    '2024-12-24', // Navidad
    '2024-12-25', // Navidad
    '2024-12-31', // Fin de Año
    // Días festivos de 2025
    '2025-01-01', // Año Nuevo
    '2025-03-03', // Lunes Carnaval
    '2025-03-04', // Martes Carnaval
    '2025-04-17', // Jueves Santo
    '2025-04-18', // Viernes Santo
    '2025-04-19', // Declaración de Independencia
    '2025-05-01', // Día del Trabajador
    '2025-06-24', // Día de la Batalla de Carabobo
    '2025-07-05', // Día de la Independencia
    '2025-07-24', // Natalicio de Simón Bolívar
    '2025-12-24', // Navidad
    '2025-12-25', // Navidad
    '2025-12-31', // Fin de Año
];

// Función para calcular días hábiles
function calcularDiasHabiles($fechaInicio, $fechaFin, $diasFeriados) {
    $inicioTimestamp = strtotime($fechaInicio) + 86400; // Sumar un día para comenzar desde el siguiente
    $finTimestamp = strtotime($fechaFin);

    $diasHabiles = 0;

    for ($current = $inicioTimestamp; $current <= $finTimestamp; $current += 86400) { // 86400 segundos en un día
        // Comprobar si es un día hábil (lunes a viernes)
        if (date('N', $current) < 6 && !in_array(date('Y-m-d', $current), $diasFeriados)) {
            $diasHabiles++;
        }
    }

    return $diasHabiles;
}

// Formatear las fechas en el formato Y-m-d
$fechaInicio = date('Y-m-d', strtotime($this->auditActivity->handoverDocument->subscription));
$fechaFin = date('Y-m-d', strtotime($this->auditActivity->handoverDocument->delivery_uai));

// Inicializar las variables de los checkboxes
$checkbox1Checked = '';
$checkbox1Disabled = '';
$checkbox25Checked = '';
$checkbox26Checked = '';
$checkbox26Disabled = '';

// Calcular los días hábiles entre las dos fechas
$diasHabiles = calcularDiasHabiles($fechaInicio, $fechaFin, $diasFeriados);

// Determinar el mensaje y el estado de los checkboxes
if ($diasHabiles > 5) {
    $diasDeRetraso = $diasHabiles - 5;
    $fechaLimite = date('d/m/Y', strtotime($fechaInicio . ' + 5 weekdays'));
    $mensaje = " Excede los 5 días por $diasDeRetraso días hábiles";
    $color = "red"; // Color rojo
    $checkbox26Checked = ''; // Desmarcar checkbox 26
    $checkbox26Disabled = 'disabled'; // Bloquear checkbox 26
    $checkbox25Checked = ''; // Desmarcar checkbox 25
    $checkbox1Checked = ''; // Desmarcar checkbox 1
    $checkbox1Disabled = 'disabled'; // Bloquear checkbox 1
} else {
    $fechaLimite = date('d/m/Y', strtotime($fechaInicio . ' + 5 weekdays'));
    $mensaje = " Esta dentro de los 5 días habiles";
    $color = "green"; // Color verde
    $checkbox26Checked = 'checked'; // Marcar checkbox 26
    $checkbox26Disabled = ''; // Habilitar checkbox 26
    $checkbox25Checked = ''; // Desmarcar checkbox 25
    $checkbox1Checked = 'checked'; // Marcar checkbox 1
    $checkbox1Disabled = ''; // Habilitar checkbox 1
}

// NUEVA FUNCIONALIDAD

$nuevaFecha = date('Y-m-d', strtotime($this->auditActivity->handoverDocument->cease)); // Fecha fija en formato Y-m-d
// Calcular la diferencia en días hábiles entre fechaInicio y nuevaFecha
$diasHabilesDiferencia = calcularDiasHabiles($nuevaFecha,$fechaInicio,$diasFeriados);

// Determinar el mensaje y el color según la diferencia
if ($diasHabilesDiferencia > 3) {
    $diasRetrasoDiferencia = $diasHabilesDiferencia - 3;
    $fechaLimiteDiferencia = date('d/m/Y', strtotime($fechaInicio . ' + 3 weekdays'));
    $mensajeDiferencia = "  Excede los 3 días por $diasHabilesDiferencia días hábiles. ";
    $colorDiferencia = "red"; // Color rojo

    // Desmarcar y bloquear el checkbox1 si se exceden los 3 días
    $checkbox1Checked = ''; // Desmarcar checkbox 1
    $checkbox1Disabled = 'disabled'; // Bloquear checkbox 1
} else {
    $fechaLimiteDiferencia = date('d/m/Y', strtotime($fechaInicio . ' + 3 weekdays'));
    $mensajeDiferencia = " Esta dentro de los 3 días hábiles";
    $colorDiferencia = "green"; // Color verde

    // Habilitar checkbox1 si está dentro de los 3 días
    $checkbox1Checked = 'checked'; // Marcar checkbox 1
    $checkbox1Disabled = ''; // Habilitar checkbox 1
}
@endphp      
{{-- todo Headings --}}
<div role="headings"> <livewire:Components.AuditActivityHeadings :$auditActivity objective></div>

            <x-section-basic> 

            
                    <link rel="stylesheet" href="/css/cedula.css">
                    <script src="/js/cedula.js"></script>
                    
            <!-- Mostrar las notas a considerar en un recuadro gris -->
            <div style="background-color: #f0f0f0; padding: 20px; border-radius: 8px; margin-top: 20px;">
                <h4 style="margin-bottom: 10px; font-size: 18px; font-weight: bold;">Notas a considerar</h4>
                <div style="background-color: white; padding: 15px; border-radius: 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);">
                    <div style="color: {{ $color }}; font-weight: bold; font-size: 16px; margin-bottom: 10px;">
                        {{ $mensaje }}
                    </div>
                    <div style="color: {{ $colorDiferencia }}; font-weight: bold; font-size: 16px; margin-bottom: 10px;">
                        {{ $mensajeDiferencia }}
                    </div>
                </div>
                                <!-- Segundo recuadro blanco -->
                <div style="background-color: white; padding: 15px; border-radius: 5px; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); margin-top: 10px;">
                    <h5 style="margin-bottom: 10px; font-size: 16px; font-weight: bold;">Información Adicional</h5>
                    <x-archivador>
                    </x-archivador>
                    <!-- Puedes agregar más contenido aquí según sea necesario -->
                </div>
                
            </div>

        
            <div id="firstModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModalAndReset('firstModal', 'checkboxForm')">&times;</span>
                    <h4>Desmarque cada casilla según los hallazgos encontrados </h4>
                    <form id="checkboxForm">
                        <div class="checkbox-container">
                            <div class="left-column">
                                <label class="checkbox-label"><input type="checkbox" id="checkbox1" name="checkbox1" value="(A) El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad." {{ $checkbox1Checked }} {{ $checkbox1Disabled }}>(A) El acta se entrego en un plazo no superior de tres (3) días hábiles, al funcionario entrante o al funcionario que designe la máxima autoridad.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox2" name="checkbox2" value="(B) El acta esta debidamente certificada por el funcionario autorizada" checked>(B) El acta esta debidamente certificada por el funcionario autorizada </label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox3" name="checkbox3" value="(C) El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega." checked>(C) El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox5" name="checkbox5" value="(E) Lugar de la suscripción del Acta." checked>(E) Lugar de la suscripción del Acta.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox6" name="checkbox6" value="(F) Fecha de la suscripción del Acta" checked>(F) Fecha de la suscripción del Acta.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox7" name="checkbox7" value="(G) Identificación del órgano, entidad, oficina o dependencia que se entrega." checked>(G) Identificación del órgano, entidad, oficina o dependencia que se entrega..</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value="(H) Identificación de quien entrega" checked>(H) Identificación de quien entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value="(I) Identificación de quien Recibe" checked>(I) Identificación de quien recibe.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox9" name="checkbox9" value="(J) Motivo de la entrega" checked>(J) Motivo de la entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox10" name="checkbox10" value="(l) Mención expresa de que los anexos forman parte integrante del acta" checked> (l)Mención expresa de que los anexos forman parte integrante del acta.</label><br>
                            </div>
                            <div class="right-column">
                                <label class="checkbox-label"><input type="checkbox" id="checkbox12"  name="checkbox12" value="(m) Suscripción del acta de quien entrega." checked>(a) Suscripción del acta de quien entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox13"  name="checkbox13" value="(n) Suscripción del acta de quien recibe." checked>(b) Suscripción del acta de quien recibe.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox14"  name="checkbox14" value="(a) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable." checked>(c) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox22"  name="checkbox22" value="(b) Mención del número de cargos exigentes." checked>(d) Mención del número de cargos exigentes.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox15"  name="checkbox15" value="(e) Inventario de los bienes muebles e inmuebles." checked>(e) Inventario de los bienes muebles e inmuebles..</label><br>
                                
                                
                                <label class="checkbox-label"><input type="checkbox" id="checkbox16"  name="checkbox16" value="(f) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente." checked> (f) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox17"  name="checkbox17" value="(g) Indice general del archivo." checked>(g) Indice general del archivo.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox18"  name="checkbox18" value="(h) Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega." checked> (h) Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega.</label><br>
                                <label class="checkbox-label"><input type="checkbox" id="checkbox19"  name="checkbox19" value="(i) El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas." checked> (i) El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas.</label><br>
                                <label class="checkbox-label"> <input type="checkbox" id="checkbox26" name="checkbox26" value="(j) El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma."{{ $checkbox26Checked }} {{ $checkbox26Disabled }}>
                                    <label for="checkbox26"> (j) El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma.</label>
                                   
                               
                            </div>
                        </div>
                        <hr class="divider">
                        <div class="additional-checkboxes">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value="(c) Estados bancarios actualizados y conciliados." checked>(c) Estados bancarios actualizados y conciliados.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox23" name="checkbox23" value="(d) Lista de comprobantes de gastos." checked>(d) Lista de comprobantes de gastos.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox24" name="checkbox24" value="(e) Cheques emitidos pendientes de cobro.." checked>(e) Cheques emitidos pendientes de cobro.</label>
                        </div>
                        <hr class="divider">
                        <div class="additional-checkboxes">
                            <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value=" (b) Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión." checked>(b) Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión.</label>
                            <label class="checkbox-label"><input type="checkbox" id="checkbox20" name="checkbox20" value=" (a) Monto de los fondos  y bienes asignados Presupuestariamente a la respectiva unidad administradora." checked> (a) Monto de los fondos  y bienes asignados Presupuestariamente  a la respectiva unidad administradora.</label>
                        </div>
                        
                        <div class="additional-checkboxes">
                            <label class="checkbox-label">
                                <input type="checkbox" id="checkbox25" name="checkbox25" wire:model="sinHallazgoChecked">
                                <label for="checkbox25">Sin Hallazgo</label>
                            </label>
                        </div>
                        
                </form>
                    <div class="button-container">
                        <button class="btn-modern btn-primary" onclick="openSecondModal()">Siguiente</button>
                        <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
                    </div>
                </div>
            </div>
    
            <!-- Botón para abrir el primer modal -->
    
            <script>


// 

  document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const checkboxSinHallazgo = document.getElementById('checkbox25');

    // Función para actualizar el estado del checkbox "Sin Hallazgo"
    function updateCheckboxSinHallazgo() {
        const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked && checkbox !== checkboxSinHallazgo);

        if (checkedCheckboxes.length === 0) {
            // Si no hay checkboxes seleccionados, marcar "Sin Hallazgo"
            checkboxSinHallazgo.checked = true;
        } else if (checkedCheckboxes.length === checkboxes.length - 1) {
            // Si todos los checkboxes (menos "Sin Hallazgo") están seleccionados, marcar "Sin Hallazgo"
            checkboxSinHallazgo.checked = true;
        } else {
            // Si hay al menos un checkbox seleccionado, desmarcar "Sin Hallazgo"
            checkboxSinHallazgo.checked = false;
        }
    }

    // Agregar eventos a cada checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCheckboxSinHallazgo);
    });
});
            </script>
            <!-- Segundo Modal -->
            <div id="secondModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModalAndReset('secondModal', 'reportForm')">&times;</span>
                <h4>Checkboxes no seleccionados</h4>
        
                <!-- Formulario para descargar Informe -->

                <form id="secondForm" action="{{ route('download-excel') }}" method="POST" onsubmit="handleDownload(event)">
                    <input type="hidden" name="auditActivityId" value="{{ $auditActivity->public_id }}">
                    @csrf
                    <div id="uncheckedCheckboxesContainer" style="margin: 20px 0;"></div>
                    <x-button type='submit' class="ml-4" id="downloadButton" onclick="handleDownload()">Descarga Cedula </x-button>
                     <button type="button" class="btn-modern dynamic-button" wire:click="informeDocumen" id="downloadReportButton">Descargar Informe del Auditor</button>
                    <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
                    <div id="downloadMessage" class="download-message"></div>
                    </form>
                    <!-- Formulario para descargar documento Word si "Sin Hallazgo" está marcado -->
                    <form id="sinHallazgoForm" action="{{ route('download-sin-hallazgo') }}" method="POST" style="display: none;">
                     @csrf
                    <input type="hidden" name="auditActivityId" value="{{ $auditActivity->public_id }}">
                      <button type="submit" class="btn-modern btn-success" id="downloadSinHallazgoButton">Descarga del AI Sin Hallazgo</button>
                </form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const checkboxSinHallazgo = document.getElementById('checkbox25');
    const sinHallazgoForm = document.getElementById('sinHallazgoForm');
    const downloadSinHallazgoButton = document.getElementById('downloadSinHallazgoButton');
    const downloadReportButton = document.getElementById('downloadReportButton');

    function updateCheckboxSinHallazgo() {
        const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked && checkbox !== checkboxSinHallazgo);

        if (checkedCheckboxes.length === 0) {
            checkboxSinHallazgo.checked = true;
        } else if (checkedCheckboxes.length === checkboxes.length - 1) {
            checkboxSinHallazgo.checked = true;
        } else {
            checkboxSinHallazgo.checked = false;
        }

        // Mostrar/ocultar el formulario de descarga si el checkbox "Sin Hallazgo" está marcado
        if (checkboxSinHallazgo.checked) {
            sinHallazgoForm.style.display = 'block';
            downloadReportButton.style.display = 'none'; // Ocultar el botón de Informe del Auditor
        } else {
            sinHallazgoForm.style.display = 'none';
            downloadReportButton.style.display = 'block'; // Mostrar el botón de Informe del Auditor
        }
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCheckboxSinHallazgo);
    });
});
</script>

<form action="{{ route('upload.documents') }}" method="POST" enctype="multipart/form-data">


            <style>
    .message {
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
    }
    .red {
        background-color: #f8d7da;
        color: #721c24;
    }
    .green {
        background-color: #a7b0a9;
        color: #155724;
    }
</style>
    
            <!-- Agregar un botón oculto en el HTML, fuera del modal -->
          



<!-- Estilo para el botón -->
<style>
    #sendEmailButton {
        position: fixed; /* Fija el botón en la pantalla */
        bottom: 20px; /* Distancia desde el fondo */
        right: 20px; /* Distancia desde la derecha */
        z-index: 1000; /* Asegúrate de que esté por encima de otros elementos */
    }
</style>

    </x-section-basic>
</div>
</div>
