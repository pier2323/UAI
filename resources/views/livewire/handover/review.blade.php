<button id="openModal">Abrir Modal</button>

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span> 
        <h2>Selecciona las opciones:</h2>
        <ul>
            <li><input type="checkbox"   > El acta se entrego en un plazo no superior de tres (3) días habiles.</li>
            <li><input type="checkbox"> El acta esta debidamente certificada por el funcionario autorizada.</li>
            <li><input type="checkbox"> El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega.</li>
            <li><input type="checkbox"> En caso de no recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y el auditor interno del organismo</li>
            <li><input type="checkbox"> Lugar de la suscripción del Acta.</li>
            <li><input type="checkbox"> Fecha de la suscripción del Acta.</li>
            <li><input type="checkbox"> Identificación del órgano, entidad, oficina o dependencia que se entrega.</li>
            <li><input type="checkbox"> Identificación de quien entrega.</li>
            <li><input type="checkbox"> Identificación de quien recibe.</li>
            <li><input type="checkbox"> Motivo de la entrega.</li>
            <li><input type="checkbox"> Fundamentación legal del motivo de la entrega.</li>
            <li><input type="checkbox">Mención expresa de que los anexos forman parte integrante del acta</li>
            <li><input type="checkbox"> Suscripción del acta de quien entrega.</li>
            <li><input type="checkbox">  Suscripción del acta de quien recibe.</li>
            <div class="">

                <li><input type="checkbox"> Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. </li>
                <li><input type="checkbox"> Mención de los empleados u obreros.</li>
                <li><input type="checkbox">Mención del número de jubilados y pensionados.</li>
                <li><input type="checkbox"> Inventario de los bienes muebles e inmuebles.</li>
                <li><input type="checkbox"> Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente.</li>
                <li><input type="checkbox">Indice general del archivo. </li>
                <li><input type="checkbox"> Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega.</li>
                <li><input type="checkbox"> El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma.</li>
                <li><input type="checkbox"> Monto de los fondos  y bienes asignados Presupuestariamente  a la respectiva unidad administradora.</li>
                <li><input type="checkbox"> Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión.</li>
                <li><input type="checkbox">Lista de comprobantes de gastos. </li>
                <li><input type="checkbox"> Cheques emitidos pendientes de cobro.</li>
             
            </div>
            </ul>
        <button id="siguiente">Siguiente</button>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Opciones no seleccionadas:</h2>
        <p id="opcionesNoSeleccionadas"></p>
        <button>Cerrar</button>
    </div>
</div>

<style>


.modal {
display: none; /* Ocultamos el modal por defecto */
position: fixed;
z-index: 1;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
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




<script>
const modal = document.getElementById('modal');
const btn = document.getElementById("openModal");
const span = document.getElementsByClassName("close")[0];
const siguienteBtn = document.getElementById('siguiente');
const modal2 = document.getElementById('modal2');
const opcionesNoSeleccionadas = document.getElementById('opcionesNoSeleccionadas');



btn.onclick = function() {
modal.style.display = "block";
}

span.onclick = function() {
modal.style.display = "none";
}

window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}

siguienteBtn.onclick = function() {
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
let noSeleccionadas = [];
checkboxes.forEach((checkbox) => {
if (!checkbox.checked) {
  noSeleccionadas.push(checkbox.parentElement.textContent.trim());
}
});




opcionesNoSeleccionadas.textContent = noSeleccionadas.join(', ');
modal.style.display = "none";
modal2.style.display = "block";
}
</script>
</div>
