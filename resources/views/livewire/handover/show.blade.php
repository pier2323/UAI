<div>
    {{-- @dump($auditActivity->id) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 = focus:outline-none shadow-sm';
    @endphp

    <x-section-basic>

        <style>

          .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro para cubrir toda la pantalla */
        transition: opacity 0.5s;
    }
    
            .modal-content {
                background-color: #f9f9f9; /* Color de fondo más suave */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
        max-width: 600px;
        margin: 5% auto;
        position: relative;
        overflow: hidden
            }

            .modal-content h4 {
        margin-bottom: 20px;
        font-family: 'Arial', sans-serif;
        color: #333;
        text-align: center; /* Centrando los títulos */
    }
    .checkbox-container {
        display: flex;
        justify-content: space-between;
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
    
            .btn {
                padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-family: 'Arial', sans-serif;
        cursor: pointer;
        transition: background 0.3s;
            }
    
                .btn-primary {
        background: #007bff;
        color: #fff;
            }
    
            .btn-danger {
                background-color: #dc3545;
                color: white;
                border: none;
            }
    
            textarea {
                width: 100%;
                height: 100px;
                resize: none;
                overflow-wrap: break-word;
                margin-top: 10px; /* Añadir espacio entre el nombre del checkbox y el textarea */
            }
    
            .notification {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #28a745;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                opacity: 0;
                transform: translateY(0);
                transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
                z-index: 1000; /* Asegura que la notificación se sobreponga a todo */
            }
    
            .notification.hide {
                opacity: 0;
                transform: translateY(-20px); /* Desliza hacia arriba */
            }
    
            .checkbox-label {
        display: block;
        padding: 10px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif;
        color: #555;
        cursor: pointer;
        transition: background 0.3s, border-color 0.3s;
    }

    .checkbox-label:hover {
        background: #f0f0f0;
        border-color: #ccc;
    }

    .checkbox-label input {
        margin-right: 10px;
    }



    .left-column, .right-column {
        width: 45%;
        text-align: justify; /* Justificar el texto */
    }

    .divider {
        border: 1px solid #FFA07A; /* Color cálido */
        margin: 20px 0;
    }

   .additional-checkboxes {
        display: flex;
        justify-content: space-between;
    }

    .additional-checkboxes .checkbox-label {
        flex: 1;
        margin-right: 10px;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-family: 'Arial', sans-serif;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-primary {
        background: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background: #0056b3;
    }
    
    .btn-modern {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-danger {
        background: #dc3545;
        color: #fff;
    }
   
    .btn-danger:hover {
        background: #c82333;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
        transition: color 0.3s;
    }

    .download-message {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(100px);
            transition: all 0.5s ease;
            z-index: 1000;
        }

        .download-message.show {
            opacity: 1;
            transform: translateY(0);
        }




/* Estilos para el botón */
#newButton {
  background-color: #6c5ce7; /* Color morado oscuro */
  border: none;
  border-radius: 20px; /* Borde redondeado */
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

#newButton:hover {
  background-color: #3498db; /* Color azul */
}

/* Estilos para el mensaje */
#message {
  display: none;
  z-index: 1000; /* Mostrar el mensaje sobre todo */
}



#message div {
  transition: opacity 0.5s; /* Agregar transición para que el mensaje aparezca suavemente */
}

#message.show div {
  opacity: 1;
}
#message.show {
  display: block;
  opacity: 1;
}

    .close:hover {
        color: #000;
    }

        </style>
<!-- Primer Modal -->
<div id="firstModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalAndReset('firstModal', 'checkboxForm')">&times;</span>
        <h4>Selecciona los Checkboxes</h4>
        <form id="checkboxForm">
            <div class="checkbox-container">
                <div class="left-column">
                    <label class="checkbox-label"><input type="checkbox" id="checkbox1" name="checkbox1" value=" El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad." checked> El acta se entrego en un plazo no superior de tres (3) días habiles, al funcionario entrante o al funcionario que designe la maxima autoridad.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox2" name="checkbox2" value="El acta esta debidamente certificada por el funcionario autorizada" checked> El acta esta debidamente certificada por el funcionario autorizada </label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox3" name="checkbox3" value=" El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega." checked> El funcionario saliente elaboró, presentó y suscribió la respectiva acta de entrega.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox4" name="checkbox4" value=" En caso de no recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y el auditor interno del organismo." checked> En caso de no recibir acta de entrega, el funcionario entrante levanto acta detallada indicando el estado en que se encuentran los asuntos, bienes y recursos asignados. Con dos testigos y el auditor interno del organismo.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox5" name="checkbox5" value="Lugar de la suscripción del Acta." checked> Lugar de la suscripción del Acta.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox6" name="checkbox6" value="Fecha de la suscripción del Acta" checked> Fecha de la suscripción del Acta.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox7" name="checkbox7" value="Identificación del órgano, entidad, oficina o dependencia que se entrega." checked>Identificación del órgano, entidad, oficina o dependencia que se entrega..</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox8" name="checkbox8" value=" Identificación de quien entrega" checked> Identificación de quien entrega.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox9" name="checkbox9" value="Motivo de la entrega" checked> Motivo de la entrega.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox10" name="checkbox10" value="Mención expresa de que los anexos forman parte integrante del acta" checked> Mención expresa de que los anexos forman parte integrante del acta.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox25" name="checkbox22" value="Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión." checked> Saldo en efectivo de dichos fondos a la fecha de entrega de la gestión.</label>
                </div>
                <div class="right-column">
                    <label class="checkbox-label"><input type="checkbox" id="checkbox12"  name="checkbox12" value="Suscripción del acta de quien entrega." checked> Suscripción del acta de quien entrega.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox13"  name="checkbox13" value="Suscripción del acta de quien recibe." checked> Suscripción del acta de quien recibe.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox14"  name="checkbox14" value=" Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable." checked> Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox15"  name="checkbox15" value="Inventario de los bienes muebles e inmuebles." checked> Inventario de los bienes muebles e inmuebles..</label><br>
              
                    <label class="checkbox-label"><input type="checkbox" id="checkbox16"  name="checkbox16" value=" Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente." checked> Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox17"  name="checkbox17" value="Indice general del archivo." checked>Indice general del archivo.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox18"  name="checkbox18" value=" Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega." checked> Datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del funcionario o empleado que entrega.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox19"  name="checkbox19" value=" El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas." checked> El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox20"  name="checkbox20" value="El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma." checked> El acta de entrega se recibio en la Unidad de Auditoria Interna dentro de los cinco (5) dias habiles siguientes a la fecha de suscripción de la misma.</label><br>
                    <label class="checkbox-label"><input type="checkbox" id="checkbox21" name="checkbox21" value="Monto de los fondos  y bienes asignados Presupuestariamente 
        a la respectiva unidad administradora." checked> Monto de los fondos  y bienes asignados Presupuestariamente 
                        a la respectiva unidad administradora.</label>
                </div>
            </div>
            <hr class="divider">
            <div class="additional-checkboxes">
                <label class="checkbox-label"><input type="checkbox" id="checkbox22" name="checkbox22" value="Estados bancarios actualizados y conciliados." checked> Estados bancarios actualizados y conciliados.</label>
                <label class="checkbox-label"><input type="checkbox" id="checkbox23" name="checkbox23" value="Lista de comprobantes de gastos." checked>Lista de comprobantes de gastos.</label>
                <label class="checkbox-label"><input type="checkbox" id="checkbox24" name="checkbox24" value="Cheques emitidos pendientes de cobro.." checked>Cheques emitidos pendientes de cobro.</label>
            
            
            
            </div>
        </form>
        <div class="button-container">
            <button class="btn-modern btn-primary" onclick="openSecondModal()">Siguiente</button>
            <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
        </div>
    </div>
</div>





<!-- Segundo Modal -->
<div id="secondModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalAndReset('secondModal', 'secondForm')">&times;</span>
        <h4>Checkboxes no seleccionados</h4>
        <form id="secondForm" action="{{ route('download-excel') }}" method="POST" onsubmit="handleDownload(event)">
            @csrf
            <div id="uncheckedCheckboxesContainer" style="margin: 20px 0;"></div>
           <button class="btn-modern btn-primary" id="downloadButton" onclick="handleDownload()">Descargar Excel</button>
           <button type="button" class="btn-modern btn-danger" onclick="closeAllModalsAndReset()">Cerrar</button>
    <div id="downloadMessage" class="download-message"></div>
        </form>
        <div class="button-container">
        </div>
    </div>
</div>



    <!-- Botón para abrir el primer modal -->
    <button class="btn btn-primary" onclick="openModal('firstModal')">Abrir Primer Modal</button>
    

    
    <script>
        const textosPorDefecto = {
            'checkbox1': ' El Acta de Entrega revela como fecha de suscripción el día 12/07/2024 y la fecha de cese de sus funciones al cargo fue el 19/07/2025; constatando que se excede por  5 días el plazo establecido para realizar dicha actividad, de conformidad con lo dispuesto en el artículo 4 de las NREOEAPROD, que indica: Artículo 4.- La entrega se efectuará mediante acta elaborada por el servidor público saliente en la fecha en que el servidor público que lo sustituya en sus funciones tome posesión del cargo, o en un plazo que no excederá de tres (3) días hábiles contados a partir de la toma de posesión.  Si para la fecha en que el servidor público saliente se separa del cargo no existiere nombramiento o designación del funcionario que lo sustituirá, la entrega se hará al funcionario público que la máxima autoridad jerárquica del respectivo ente u organismo designe para tal efecto.',
            'checkbox2': 'Texto por defecto para checkbox2',
            'checkbox3': '*El Acta de Entrega no menciona el funionario saliente de la dependencia entregada, de conformidad con lo establecido en el artículo 8 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente:  Corresponderá a los servidores públicos salientes la elaboración, presentación y suscripción de la respectiva acta de entrega',
            'checkbox4': 'Texto por defecto para checkbox4',
            'checkbox5': 'El Acta de Entrega no señala el lugar de suscripción de la dependencia entregada,  de conformidad con lo establecido en el artículo 10 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente: <br>Artículo 10.- El acta de entrega deberá contener lo siguiente:',
            'checkbox6': ' El Acta de Entrega no señala la fecha de suscripción de la dependencia entregada,  de conformidad con lo establecido en el artículo 10 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y sus Respectivas Oficinas o Dependencias (NREOEAPROD), el cual señala lo siguiente:  Artículo 10.- El acta de entrega deberá contener lo siguiente:  1) Lugar y fecha de la suscripción del acta.  2) Identificación del órgano, entidad, oficina o dependencia que se entrega.   3) Identificación de quien entrega y de quien recibe.  4) Motivo de la entrega y su fundamentación legal.  5) Relación de los anexos que acompañan al acta y que se mencionan en los Artículos 11 al 17 de las presentes Normas, según sea el caso, con mención expresa de que forman parte integrante del acta.  6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
            'checkbox7': ' No se incorporo en el Acta de Entrega, información en cuanto a la Identificación de la dependencia que se entrega; al respecto el artículo 10 de las NREOEAPROD, Artículo 10.- El acta de entrega deberá contener lo siguiente:  (…). 2) Identificación del órgano, entidad, oficina o dependencia que se entrega.(…).',

            'checkbox8': 'No se incorporo en el Acta de Entrega, información en cuanto a la identificación de quien recibe en calidad de entrante; al respecto el artículo 10 de las NREOEAPROD, establece: Artículo 10.- El acta de entrega deberá contener lo siguiente:   1) Lugar y fecha de la suscripción del acta.  2) Identificación del órgano, entidad, oficina o dependencia que se entrega.  3) Identificación de quien entrega y de quien recibe.    4) Motivo de la entrega y su fundamentación legal.   5) Relación de los anexos que acompañan al acta y que se mencionan en los Artículos 11 al 17 de las presentes Normas, según sea el caso, con mención expresa de que forman parte integrante del acta.  6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
            'checkbox9': ' De la revisión a los datos e información que debe contener el acta de entrega de la {{ $auditActivity->description }}, se constató la omisión del aspecto siguiente: Motivo de la entrega y su fundamentación legal; al respecto, las Normas que regulan la entrega, establecen lo siguiente: Artículo 10.- “El acta de entrega deberá contener lo siguiente:   (…). 4) Motivo de la entrega y su fundamentación legal.(…). ',
            'checkbox10': ' De la revisión a los datos e información que debe contener el acta de entrega de la {{ $auditActivity->description }}, se constató la omisión del aspecto siguiente: Motivo de la entrega y su fundamentación legal; al respecto, las Normas que regulan la entrega, establecen lo siguiente: Artículo 10.- “El acta de entrega deberá contener lo siguiente:   (…). 4) Motivo de la entrega y su fundamentación legal.(…).',
            'checkbox11': ' De la revisión a los datos e información que debe contener el acta de entrega de la  {{ $auditActivity->description }}, , se constató la omision de la mención expresa de los anexos que la acompañan.Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente: “El acta de entrega deberá contener lo siguiente: (….)  5) Relación de los anexos que acompañan al acta (…)',
            'checkbox12': 'En la revisión del acta de entrega se observó que el servidor público saliente no suscribió el acta de entrega, como lo establece el artículo 8 de las NREOEAPROD, citó: Artículo 8.- Corresponderá a los servidores públicos salientes la elaboración, presentación y suscripción de la respectiva acta de entrega.',
            'checkbox13': ' De la revisión a los datos e información que debe contener el acta de entrega de la  {{ $auditActivity->description }},, se constató la omision de la mención expresa de los anexos que la acompañan.Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente: “El acta de entrega deberá contener lo siguiente: (….)  5) Relación de los anexos que acompañan al acta (…)Al respecto,  las Normas que regulan la entrega, al referirse a los aspectos que debe contener el Acta de Entrega, establece en su artículo 10, lo siguiente : El acta de entrega deberá contener lo siguiente: (…).6) Suscripción del acta por parte de quien entrega y de quien recibe. ',
            'checkbox14': ' Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos respecto a la situación presupuestaria, de conformidad con lo dispuesto en el artículo 11, numeral 1 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.',



            'checkbox15': 'Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos respecto a la situación presupuestaria, de conformidad con lo dispuesto en el artículo 11, numeral 1 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.De la verificación del Inventario de bienes muebles incorporado en el Anexo Nro. 3,  se constataron debilidades en cuanto a la exactitud de la información, las cuales se detallan a continuación: Al respecto, el Manual de Normas de Control Interno sobre un Modelo Genérico de la Administración Central y Descentralizada Funcionalmente (MNCIMGACDF), indica: Punto 4.11.9 Custodia de Bienes:"En los organismos o entes de la administración pública, el jefe de la unidad a la que han sido adscritos los bienes es responsable del control y custodia de los mismos".',
            'checkbox16': 'Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable. 2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo.6) Cualquier otra información o documentación que se considere necesaria.',
            'checkbox17': 'Se constató que el servidor público saliente no incorporó en el acta de entrega ni en sus anexos, información o documentos relacionados al Índice General del Archivo, de conformidad con lo dispuesto en el artículo 11, numeral 5 de las NREOEAPROD : Artículo 11.- El acta de entrega a que se refiere el Artículo anterior deberá acompañarse de los anexos siguientes: 1) Estado de las cuentas que refleje la situación presupuestaria, financiera y patrimonial, cuando sea aplicable.2) Mención del número de cargos existentes, con señalamiento de si son empleados u obreros, fijos o contratados, así como el número de jubilados y pensionados, de ser el caso. 3) Inventario de los bienes muebles e inmuebles. 4) Situación de la ejecución del plan operativo de conformidad con los objetivos propuestos y las metas fijadas en el presupuesto correspondiente. 5) Índice general del archivo. 6) Cualquier otra información o documentación que se considere necesaria.',
            'checkbox18': 'Se verificó que los anexos que acompañan el acta de entrega, no señalan la fecha de corte de los datos e información en ellos contenida. Al respecto, las precitadas Normas, citan: Artículo 18.- Los anexos del acta de entrega deberán incluir datos e información, con fecha de corte al momento del cese en el ejercicio del empleo, cargo o función pública del servidor público que entrega. Es resonsabilidad de quien entrega, la exactitud del acta y sus anexos tanto cualitativa como cuantitativamente.',
            'checkbox19': 'Se constató que el Acta de Entrega y sus anexos fueron consignados ante la Unidad de Auditoría Interna en copias simples. Al respecto, las NREOEAPROD, en su artículo 21, establece:  “Artículo 21.- El acta de entrega y sus anexos se elaborarán en original y tres (3) copias certificadas. Una vez suscrita el acta, el original se archivará en el despacho de la máxima autoridad jerárquica del órgano o entidad, o en la oficina o dependencia que se entrega; una (1) copia certificada se entregará al servidor público que recibe; una (1) al servidor público que entrega; y una (1) a la unidad de auditoría interna del órgano o entidad, dentro de los cinco (5) días hábiles siguientes de la fecha de suscripción de la mencionada acta.”',
            'checkbox20':'' ,
            'checkbox21': '',
            'checkbox22': '',
             'checkbox22': '',
             'checkbox22': '',
         

            
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
        });

        closeModal('firstModal');
        setTimeout(() => { openModal('secondModal'); }, 500); // Esperar la transición antes de abrir el segundo modal
    }

    function closeModalAndReset(modalId, formId) {
            document.getElementById(modalId).style.display = 'none';
            setTimeout(() => {
                document.getElementById(formId).reset();
                document.getElementById('downloadMessage').innerText = '';
            }, 8000); // 8000 ms = 8 segundos
        }
    
</script>
    
<!-- Agregar un botón oculto en el HTML, fuera del modal -->
<button  wire:click='InformeDocumen' id="newButton" style="display: none;" class="btn btn-primary">Descargar Informe del Auditor</button>

<!-- Agregar un elemento para mostrar el mensaje -->
<div id="message" style="position: fixed; bottom: 20px; right: 20px;background-color: #28a745;
            color: #fff;; padding: 10px; border-radius: 5px; display: none;"></div>
    <p id="messageText"></p>
        <livewire:Components.AuditActivityHeadings :$auditActivity>
            

        
        <title> Acatas</title>
          </div>
        </div>
        <br>
            <br>
            <br>
            <x-Card>
                <x-slot:titulo>
                    Detalles del Acta
                </x-slot>
                <x-slot:des>
                    <li> Codigo de la Actuación:<br>
                        {{ $auditActivity->code }}</li>
                    <li> Descripcion :
                        <br>
                        {{ $auditActivity->description }}
                    </li>
                    <li> Mes inicio: &nbsp; &nbsp;

                        <br>{{ $auditActivity->month_start }}
                    </li>
                    <li>
                        Mes fin:
                        <br>
                        {{ $auditActivity->month_end }}
                    </li>
                    <li>
                        Area Encargada:
                        <br>
                        {{ $auditActivity->uai->name }}

                    </li>
                    <li>
                        Personal designado:
                        <br>
                        {{$auditActivity->first_name}} </li>
                        @foreach ($auditActivity->employee as $employee)
                            <p>{{ $employee->first_name }} {{ $employee->first_surname }}</p>
                         
                        @endforeach


                        
                </x-slot>
            </x-Card>
            <br>
            <div style="margin-left: 400px; margin-top: -570px;">

                <x-Card>
                    <x-slot:titulo>
                        Detalles del entrante
                    </x-slot>
                    <x-slot:des>
                        <li> Nombre: <br></li>
                        <li> Cedula: <br> </li>
                        <li> P00: <br></li>
                        <li> Cargo: <br></li>
                        <li>telefono: <br></li>
                        <li>Coreo eletronico: <br></li>
                    </x-slot>
                </x-Card>

            </div>
            <div style="margin-left: 800px; margin-top: -405px;">
                <x-Card>
                    <x-slot:titulo>
                        Detalles del Saliente
                    </x-slot>
                    <x-slot:des>
                        <li> Nombre: <br></li>
                        <li> Cedula: <br></li>
                        <li> P00: <br></li>
                        <li> Cargo: <br></li>
                        <li>telefono: <br></li>
                        <li>Coreo eletronico: <br></li>
                    </x-slot>
                </x-Card>
            </div>

            <x-button style="margin-top: 200px" wire:click='requeriDocumen'> Requerimiento</x-button>
            <x-button wire:click='programaDocumen'> Programa de trabajo</x-button>
            <x-button style="margin-left:340px" wire:click='CedulaDocumen'>Cedula de trabajo </x-button>
            <x-button wire:click='InformeDocumen'>Informe del Auditor </x-button>
    </x-section-basic>
</div>
