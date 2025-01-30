<div>
    <div>
        <!-- Botón flotante -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <button id="floatingButton" style="position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <i class="fas fa-search" style="font-size: 24px;"></i>
    </button>
    
    <!-- Modal -->
    <div id="instructionsModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
        <div class="modal-content" style="background-color: white; padding: 20px; border-radius: 8px; width: 90%; max-width: 600px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <span class="close" onclick="closeModal()" style="cursor: pointer; float: right; font-size: 24px;">&times;</span>
            <h4 id="instructionsHeader" style="margin-bottom: 10px; font-size: 24px; font-weight: bold; color: #007bff;">📝 Instrucciones para el Proceso</h4>
            
            <!-- Most Searched Items -->
            <h5 id="mostSearchedHeader" style="font-size: 20px; font-weight: bold; color: #007bff;">🔝 Búsquedas más consultadas</h5>
            <ul id="mostSearchedList" style="font-size: 18px; line-height: 1.6; margin-bottom: 20px;">
                <li style="margin-bottom: 10px; position: relative;">
                    <a href="#" onclick="toggleActaDeEntregaSublist()" style="text-decoration: none; color: inherit;">📑 Actas de Entrega</a>
                    <ul id="actaDeEntregaSublist" style="display: none; position: absolute; top: 0; left: 200px; margin-top: 0; margin-left: 20px; border-left: 2px solid #007bff; padding-left: 10px;">
                        <li style="margin-bottom: 10px;"><a href="#" onclick="showRegistroDeActa()" style="text-decoration: none; color: inherit;">Registro de Acta</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" onclick="showPlanOperativoAnual()" style="text-decoration: none; color: inherit;">Plan Operativo Anual</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" onclick="showActaDeEntrega()" style="text-decoration: none; color: inherit;">Acta de Entrega</a></li>
                    </ul>
                </li>
                <li style="margin-bottom: 10px;"><a href="#" onclick="showMemo()" style="text-decoration: none; color: inherit;">📝 Memo</a></li>
            </ul>

            <ol id="instructionsList" style="font-size: 18px; line-height: 1.6;">
               
            </ol>


            <!-- Memo Content -->
            <div id="memoContent" style="display: none;">
                <h4 style="margin-bottom: 10px; font-size: 24px; font-weight: bold; color: #007bff;">📝 Memo</h4>
                <br>
                <p style="font-size: 18px; line-height: 1.6; text-align: justify;"><strong>¿Qué es un memorando?</strong></p>
                <br>
                <p style="font-size: 18px; line-height: 1.6; text-align: justify;">Un memorando, o memo, es un documento corto y formal usado dentro de una empresa para comunicar información importante a empleados. Es como un aviso interno, pero más detallado.</p>
               <br>
                <p style="font-size: 18px; line-height: 1.6; text-align: justify;"><strong>¿Para qué sirve?</strong></p>
                <br>
                <ul style="font-size: 18px; line-height: 1.6; text-align: justify; list-style-type: disc;">
                    <li style="margin-bottom: 10px;">Informar: Anunciar cambios, novedades o resultados.</li>
                    <li style="margin-bottom: 10px;">Dar órdenes: Instruir a los empleados sobre tareas o procedimientos.</li>
                    <li style="margin-bottom: 10px;">Recordar: Avisar sobre fechas importantes o reuniones.</li>
                    <li style="margin-bottom: 10px;">Documentar: Registrar decisiones o acuerdos para futuras referencias.</li>
                </ul>
            </div>

            <!-- Acta de Entrega Content -->
            <div id="actaDeEntregaContent" style="display: none; overflow-y: auto; max-height: 80vh;">
                <button onclick="closeActaDeEntregaContent()" style="float: right; background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
                <h4 style="margin-bottom: 10px; font-size: 22px; font-weight: bold; color: #007bff; text-align: center;">📑 Acta de Entrega</h4>
                <br>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    En la pestaña '<strong>Acta de Entrega</strong>', aparecerá un cuadro con el <strong>código del acta</strong>, la <strong>descripción</strong>, el <strong>mes de inicio</strong>, el <strong>mes final</strong> y el <strong>área encargada</strong>. En este cuadro se mostrarán las actas de entrega ya designadas y acreditadas.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    El siguiente paso es hacer <strong>doble clic</strong> en el dato del acta. Una vez que cargue la otra página, aparecerán la <strong>descripción del acta</strong>, el <strong>código</strong> y los <strong>datos del acta</strong>. Si el acta supera los <strong>3 o 5 días establecidos por la ley</strong>, se indicará.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Un poco más abajo, hay una sección con pestañas llamada '<strong>Programa de trabajo</strong>'. En la pestaña '<strong>Cédula</strong>', se encontrarán los datos del <strong>entrante</strong> y del <strong>saliente</strong>. Después de estos datos, habrá tres botones: '<strong>Requerimiento</strong>', '<strong>Programa de trabajo</strong>' y '<strong>Enviar requerimiento por Zimbra</strong>'. Para descargar el requerimiento y el programa de trabajo, solo es necesario hacer clic en los botones correspondientes.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    <strong>Importante:</strong> Antes de hacer clic en '<strong>Enviar requerimiento por Zimbra</strong>', asegúrate de que Zimbra esté abierto.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    En la pestaña '<strong>Cédula</strong>', encontrarás un cuadro para ingresar la <strong>fecha de suscripción</strong>. Al hacer clic en '<strong>Mostrar fecha</strong>', se abrirá un calendario. Debajo del cuadro, se mostrará información importante sobre si la fecha está dentro o fuera de los <strong>120 días</strong> y cuántos días faltan para cumplirse este plazo.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Después de esta información, hay un botón que dice '<strong>Revisión de cédula</strong>'. Al hacer clic en él, aparecerá un modal con los <strong>hallazgos del acta</strong>. Si los hallazgos están marcados, significa que no hay hallazgos. Si están desmarcados, significa que hay hallazgos.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Una vez que el auditor coloque los hallazgos, aparecerán dos botones: '<strong>Siguiente</strong>' y '<strong>IA sin hallazgos</strong>'. El botón '<strong>IA sin hallazgos</strong>' solo aparece si no hay hallazgos, y el botón '<strong>Siguiente</strong>' aparece si hay hallazgos.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Si hay hallazgos, al hacer clic en '<strong>Siguiente</strong>', aparecerá otro modal con un <strong>resumen de los hallazgos</strong>. El auditor revisará y ajustará este resumen según sea necesario. Abajo, habrá dos botones: '<strong>Cédula</strong>' e '<strong>Informe del auditor</strong>'. Al hacer clic en ellos, se descargarán los documentos correspondientes.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Una vez que el auditor revise la cédula y el informe, se procederá a la pestaña '<strong>Descarga de documentos</strong>'. Aquí, se cargarán al sistema los documentos del programa de trabajo para guardarlos.
                </p>
                <p style="font-size: 16px; line-height: 1.6; text-align: justify;">
                    Por último, se generarán las <strong>conclusiones y recomendaciones</strong>. Al hacer clic en el botón correspondiente, se abrirá un modal que preguntará si hay <strong>CECO</strong>. Después de seleccionar la respuesta, se descargará un documento .docx con las conclusiones y recomendaciones. El usuario pegará su informe con las conclusiones y recomendaciones en este documento para obtener el informe definitivo.
                </p>
                <button onclick="closeActaDeEntregaContent()" style="display: block; margin: 20px auto; background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Atrás</button>
            </div>
        </div>
    </div>
    </div>
    
    <script>
    // Función para abrir el modal
    document.getElementById('floatingButton').onclick = function() {
        document.getElementById('instructionsModal').style.display = 'flex';
    };
    
    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('instructionsModal').style.display = 'none';
        document.getElementById('instructionsHeader').style.display = 'block';
        document.getElementById('mostSearchedHeader').style.display = 'block';
        document.getElementById('mostSearchedList').style.display = 'block';
        document.getElementById('instructionsList').style.display = 'block';
        document.getElementById('actaDeEntregaContent').style.display = 'none';
        document.getElementById('memoContent').style.display = 'none';
    }

    // Función para mostrar el contenido de Acta de Entrega
    function showActaDeEntrega() {
        document.getElementById('instructionsHeader').style.display = 'none';
        document.getElementById('mostSearchedHeader').style.display = 'none';
        document.getElementById('mostSearchedList').style.display = 'none';
        document.getElementById('instructionsList').style.display = 'none';
        document.getElementById('actaDeEntregaContent').style.display = 'block';
        document.getElementById('memoContent').style.display = 'none';
    }

    // Función para mostrar el contenido de Memo
    function showMemo() {
        document.getElementById('instructionsHeader').style.display = 'none';
        document.getElementById('mostSearchedHeader').style.display = 'none';
        document.getElementById('mostSearchedList').style.display = 'none';
        document.getElementById('instructionsList').style.display = 'none';
        document.getElementById('actaDeEntregaContent').style.display = 'none';
        document.getElementById('memoContent').style.display = 'block';
    }

    function toggleActaDeEntregaSublist() {
        var sublist = document.getElementById('actaDeEntregaSublist');
        if (sublist.style.display === 'none') {
            sublist.style.display = 'block';
        } else {
            sublist.style.display = 'none';
        }
    }

    function showRegistroDeActa() {
        document.getElementById('instructionsHeader').style.display = 'none';
        document.getElementById('mostSearchedHeader').style.display = 'none';
        document.getElementById('mostSearchedList').style.display = 'none';
        document.getElementById('instructionsList').style.display = 'none';
        document.getElementById('actaDeEntregaContent').style.display = 'block';
        document.getElementById('memoContent').style.display = 'none';
        // Add content for Registro de Acta
    }

    function showPlanOperativoAnual() {
        document.getElementById('instructionsHeader').style.display = 'none';
        document.getElementById('mostSearchedHeader').style.display = 'none';
        document.getElementById('mostSearchedList').style.display = 'none';
        document.getElementById('instructionsList').style.display = 'none';
        document.getElementById('actaDeEntregaContent').style.display = 'block';
        document.getElementById('memoContent').style.display = 'none';
        // Add content for Plan Operativo Anual
    }

    function closeActaDeEntregaContent() {
        document.getElementById('actaDeEntregaContent').style.display = 'none';
        document.getElementById('instructionsHeader').style.display = 'block';
        document.getElementById('mostSearchedHeader').style.display = 'block';
        document.getElementById('mostSearchedList').style.display = 'block';
        document.getElementById('instructionsList').style.display = 'block';
    }
    </script>
    
    <style>
        .modal {
        display: none; /* Ocultar modal por defecto */
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background-color: rgba(0, 0, 0, 0.5); 
        justify-content: center; 
        align-items: center; 
        z-index: 1000; /* Asegúrate de que esté por encima de otros elementos */
    }
    </style>
    
    
    </div>
</div>