
//texto por defecto de los checkbox
const textosPorDefecto = {
    'checkbox1':  'El Acta de Entrega revela como fecha de suscripción el día  y la fecha de cese de sus funciones al cargo fue el ; constatando que se excede por  5 días el plazo establecido para realizar dicha actividad, de conformidad con lo dispuesto en el artículo 4 de las NREOEAPROD, que indica: Artículo 4.- La entrega se efectuará mediante acta elaborada por el servidor público saliente en la fecha en que el servidor público que lo sustituya en sus funciones tome posesión del cargo, o en un plazo que no excederá de tres (3) días hábiles contados a partir de la toma de posesión.  Si para la fecha en que el servidor público saliente se separa del cargo no existiere nombramiento o designación del funcionario que lo sustituirá, la entrega se hará al funcionario público que la máxima autoridad jerárquica del respectivo ente u organismo designe para tal efecto.',
    'checkbox2':  'Texto por defecto para checkbox2',
    'checkbox3':  'El Acta de Entrega no menciona el funionario saliente de la dependencia entregada, de conformidad con lo establecido en el artículo 8 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente:  Corresponderá a los servidores públicos salientes la elaboración, presentación y suscripción de la respectiva acta de entrega',
    'checkbox4':  'Texto por defecto para checkbox4',
    'checkbox5':  'El Acta de Entrega no señala el lugar de suscripción de la dependencia entregada,  de conformidad con lo establecido en el artículo 10 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente: <br>Artículo 10.- El acta de entrega deberá contener lo siguiente:',
    'checkbox6':  'El Acta de Entrega no señala la fecha de suscripción de la dependencia entregada,  de conformidad con lo establecido en el artículo 10 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente:  Artículo 10.- El acta de entrega deberá contener lo siguiente:  1) Lugar y fecha de la suscripción del acta.  2) Identificación del órgano, entidad, oficina o dependencia que se entrega.   3) Identificación de quien entrega y de quien recibe.  4) Motivo de la entrega y su fundamentación legal.  5) Relación de los anexos que acompañan al acta y que se mencionan en los Artículos 11 al 17 de las presentes Normas, según sea el caso, con mención expresa de que forman parte integrante del acta.  6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
    'checkbox7':  'No se incorporo en el Acta de Entrega, información en cuanto a la Identificación de la dependencia que se entrega; al respecto el artículo 10 de las NREOEAPROD, Artículo 10.- El acta de entrega deberá contener lo siguiente:  (…). 2) Identificación del órgano, entidad, oficina o dependencia que se entrega.(…).',

    'checkbox8': 'No se incorporo en el Acta de Entrega, información en cuanto a la identificación de quien recibe en calidad de entrante; al respecto el artículo 10 de las NREOEAPROD, establece: Artículo 10.- El acta de entrega deberá contener lo siguiente:   1) Lugar y fecha de la suscripción del acta.  2) Identificación del órgano, entidad, oficina o dependencia que se entrega.  3) Identificación de quien entrega y de quien recibe.    4) Motivo de la entrega y su fundamentación legal.   5) Relación de los anexos que acompañan al acta y que se mencionan en los Artículos 11 al 17 de las presentes Normas, según sea el caso, con mención expresa de que forman parte integrante del acta.  6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
    'checkbox9': ' De la revisión a los datos e información que debe contener el acta de entrega de la , se constató la omisión del aspecto siguiente: Motivo de la entrega y su fundamentación legal; al respecto, las Normas que regulan la entrega, establecen lo siguiente: Artículo 10.- “El acta de entrega deberá contener lo siguiente:   (…). 4) Motivo de la entrega y su fundamentación legal.(…). ',
    'checkbox10': ' De la revisión a los datos e información que debe contener el acta de entrega de la , se constató la omisión del aspecto siguiente: Motivo de la entrega y su fundamentación legal; al respecto, las Normas que regulan la entrega, establecen lo siguiente: Artículo 10.- “El acta de entrega deberá contener lo siguiente:   (…). 4) Motivo de la entrega y su fundamentación legal.(…).',
    'checkbox11': ' De la revisión a los datos e información que debe contener el acta de entrega de la  , , se constató la omision de la mención expresa de los anexos que la acompañan.Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente: “El acta de entrega deberá contener lo siguiente: (….)  5) Relación de los anexos que acompañan al acta (…)',
    'checkbox12': 'En la revisión del acta de entrega se observó que el servidor público saliente no suscribió el acta de entrega, como lo establece el artículo 8 de las NREOEAPROD, citó: Artículo 8.- Corresponderá a los servidores públicos salientes la elaboración, presentación y suscripción de la respectiva acta de entrega.',
    'checkbox13': ' De la revisión a los datos e información que debe contener el acta de entrega de la  ,, se constató la omision de la mención expresa de los anexos que la acompañan.Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente: “El acta de entrega deberá contener lo siguiente: (….)  5) Relación de los anexos que acompañan al acta (…)Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente : El acta de entrega deberá contener lo siguiente: (…).6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
    'checkbox14': ' Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos respecto a la situación presupuestaria, de conformidad con lo dispuesto en el artículo 11, numeral 1 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.',

    'checkbox15': 'Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos respecto a la situación presupuestaria, de conformidad con lo dispuesto en el artículo 11, numeral 1 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.De la verificación del Inventario de bienes muebles incorporado en el Anexo Nro. 3,  se constataron debilidades en cuanto a la exactitud de la información, las cuales se detallan a continuación: Al respecto, el Manual de Normas de Control Interno sobre un Modelo Genérico de la Administración Central y Descentralizada Funcionalmente (MNCIMGACDF), indica: Punto 4.11.9 Custodia de Bienes:"En los organismos o entes de la administración pública, el jefe de la unidad a la que han sido adscritos los bienes es responsable del control y custodia de los mismos".',
    'checkbox16': 'Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo.6) Cualquier otra información o documentación que se considere necesaria.',
    'checkbox17': 'Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos relacionados al Índice General del Archivo, de conformidad con lo dispuesto en el artículo 11, numeral 5 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.',
    'checkbox18': 'Se verificó que los anexos que acompañan el acta de entrega, no señalan la fecha de corte de los datos e información en ellos contenida. Al respecto, las precitadas Normas, citan: Artículo 18.- Los anexos del acta de entrega deberán incluir datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del servidor público que entrega. Es resonsabilidad de quien entrega, la exactitud del acta y sus anexos tanto cualitativa como cuantitativamente.',
    'checkbox19': 'Se constató que el Acta de Entrega y sus anexos fueron consignados ante la Unidad de Auditoría Interna en copias simples. Al respecto, las NREOEAPROD, en su artículo 21, establece:  “Artículo 21.- El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas. Una vez suscrita el acta, el original se archivará en el despacho de la máxima autoridad jerárquica del órgano o entidad, o en la oficina o dependencia que se entrega; una (1) copia certificada se entregará al servidor público que recibe; una (1) al servidor público que entrega; y una (1) a la unidad de auditoría interna del órgano o entidad, dentro de los cinco (5) días hábiles siguientes de la fecha de suscripción de la mencionada acta.”',
    'checkbox20': '',
    'checkbox21':'Artículo 21.- El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas. Una vez suscrita el acta, el original se archivará en el despacho de la máxima autoridad jerárquica del órgano o entidad, o en la oficina o dependencia que se entrega; una (1) copia certificada se entregará al servidor público que recibe; una (1) al servidor público que entrega; y una (1) a la unidad de auditoría interna del órgano o entidad, dentro de los cinco (5) días hábiles siguientes de la fecha de suscripción de la mencionada acta' ,
    'checkbox22': 'Al cotejar el listado del personal adscrito a la "", con fecha de corte al "  y la suministrada por la Gerencia Atención y Desarrollo Gestión Humana , con la relación de personal inserta en el Acta de Entrega, se determinó la cantidad de  DESCRIBIR EL HALLAZGO XX  cargos vacantes no relacionado según el listado de Gestión Humana  Artículo 18.- “Los anexos del acta de entrega deberán incluir datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del servidor público que entrega. Es responsabilidad de quien entrega, la exactitud del acta y sus anexos tanto cualitativa como cuantitativamente.”',
    
    
 

    
};

function openModal(modalId) {
const modal = document.getElementById(modalId);
modal.style.display = 'block';
setTimeout(() => { modal.style.opacity = '1'; }, 10); // Para activar la transición
}
function closeAllModalsAndReset() {
const modals = document.querySelectorAll('.modal');
const forms = document.querySelectorAll('form');

modals.forEach(modal => {
    modal.style.opacity = '0';
    setTimeout(() => { 
        modal.style.display = 'none'; 
    }, 500);
});

forms.forEach(form => {
    form.reset();
});
}

function closeModal(modalId) {
const modal = document.getElementById(modalId);
modal.style.opacity = '0';
setTimeout(() => { modal.style.display = 'none'; }, 500); // Tiempo para la transición
}

function handleDownload() {
    showDownloadMessage("Descarga iniciada");

    // Simular una descarga de archivo
    setTimeout(() => {
        showDownloadMessage("Descarga finalizada");
        document.getElementById('secondModal').style.display = 'none'; // Cerrar el modal después de la descarga
        setTimeout(() => {
            document.getElementById('secondForm').reset(); // Resetear el formulario después de un tiempo
            document.getElementById('downloadMessage').innerText = '';
        }, 6000); // 56000 ms = 56 segundos
    }, 2000); // 10000 ms = 10 segundos


    const newButton = document.getElementById('newButton');
newButton.style.display = 'block';

// Agregar evento de clic al botón
newButton.addEventListener('click', () => {
const message = document.getElementById('message');
message.innerHTML = 'Descarga del informe del auditor';
message.style.display = 'block';
setTimeout(() => {
message.style.display = 'none';
}, 3000); // Ocultar el mensaje después de 3 segundos
});
}

function showDownloadMessage(message) {
    const downloadMessage = document.getElementById('downloadMessage');
    downloadMessage.textContent = message;
    downloadMessage.classList.add('show');

    setTimeout(() => {
        downloadMessage.classList.remove('show');
    }, 5000);
}


function openSecondModal() {
    const checkboxes = document.querySelectorAll('#checkboxForm input[type="checkbox"]');
    const uncheckedContainer = document.getElementById('uncheckedCheckboxesContainer');
    uncheckedContainer.innerHTML = '';

    checkboxes.forEach((checkbox, index) => {
        if (checkbox.id !== 'checkbox25') { // Excluir el checkbox de "Sin Hallazgo"
            const inputHidden = document.createElement('input');
            inputHidden.type = 'hidden';
            inputHidden.name = `checkboxes[${index}]`;
            inputHidden.value = checkbox.checked ? '0' : '1'; // Marcados son 0 y no marcados son 1
            uncheckedContainer.appendChild(inputHidden);

            if (!checkbox.checked) {
                const div = document.createElement('div');
                div.textContent = checkbox.value;
                uncheckedContainer.appendChild(div);

                const textarea = document.createElement('textarea');
                textarea.name = `uncheckedCheckboxes[${index}]`;
                textarea.placeholder = `Input for ${checkbox.value}`;
                textarea.value = textosPorDefecto[checkbox.id] || ''; // Mensaje por defecto individual
                uncheckedContainer.appendChild(textarea);
            }
        }
    });

    // Verificar si el checkbox "Sin Hallazgo" está marcado
    const sinHallazgoCheckbox = document.getElementById('checkbox25');
    if (sinHallazgoCheckbox.checked) {
        const sinHallazgoLabel = document.createElement('label');
        sinHallazgoLabel.textContent = 'Sin Hallazgo:';
        uncheckedContainer.appendChild(sinHallazgoLabel); // Agregar el nombre del checkbox

        const sinHallazgoInput = document.createElement('textarea'); // Cambiar a textarea para mayor tamaño
        sinHallazgoInput.name = 'sinHallazgo';
        sinHallazgoInput.placeholder = 'Ingrese detalles sobre el hallazgo...';
        sinHallazgoInput.value = 'Sin Hallazgo'; // Valor por defecto
        sinHallazgoInput.style.width = '100%'; // Ajustar el ancho
        sinHallazgoInput.style.height = '100px'; // Ajustar la altura
        sinHallazgoInput.style.overflowY = 'scroll'; // Agregar scroll vertical
        uncheckedContainer.appendChild(sinHallazgoInput);
    }

    closeModal('firstModal');
    setTimeout(() => { openModal('secondModal'); }, 500); // Esperar la transición antes de abrir el segundo modal
}