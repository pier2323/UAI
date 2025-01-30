<div>
    <x-section-basic>

        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .cuadro {
                background-color: lightgray;
                display: flex;
                flex-direction: column; /* Cambiado a columna para que los inputs se alineen verticalmente */
                border: 1px solid #ccc;
                height: auto; /* Cambiado a auto para que se ajuste al contenido */
                margin-top: 20px;
                padding: 10px; /* Añadido padding para un mejor espaciado */
            }
            .mitad {
                flex: 1;
                border-bottom: 1px solid #ccc; /* Cambiado a borde inferior */
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                height: 50px; /* Altura fija para las secciones de datos */
            }
            .mitad:last-child {
                border-bottom: none; /* Elimina el borde inferior de la última mitad */
            }
            button {
                margin: 10px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
            }
            .select-container {
                display: none; /* Oculto por defecto */
                margin-top: 10px;
            }
            select {
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 200px;
            }
            .input-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 20px;
        }
        .input-group {
            display: flex;
            flex-direction: column;
        }
        textarea {
    width: 100%; /* Cambiar a 100% para que ocupe todo el ancho del contenedor */
    max-width: 300px; /* Establecer un ancho máximo para hacerlo más estrecho */
    min-width: 150px; /* Establecer un ancho mínimo */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Asegurarse de que el padding no afecte el ancho total */
    resize: none; /* Evitar el cambio de tamaño manual */
    transition: border-color 0.3s, box-shadow 0.3s; /* Transiciones suaves */
}

/* Estilo al enfocar el textarea */
textarea:focus {
    border-color: #007BFF; /* Cambiar el color del borde al enfocar */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Sombra suave al enfocar */
}
        </style>
    </head>
    <body>
    
    <div>
        <button id="btnMetodo">Seleccione Memo</button>
        <button id="btnMemo">Seleccione Oficio</button>
       
        <div class="select-container" id="selectContainer">
            <label for="metodos">Elige un Memo :</label>
            <select id="metodos">
                <option value="">-- Seleccione --</option>
                <option value="metodo1">Memo SEG</option>
                <option value="metodo2">Memo 2</option>
                <option value="metodo3">Memo 3</option>
            </select>
        </div>
    
        <div class="cuadro">
            <div class="mitad">Datos</div>
            <div class="input-container" id="inputContainer"></div> <!-- Mover aquí -->
        </div>      

        <!-- Botones adicionales -->
        <button id="btnDescargar">Descargar</button>
        <button id="btnZimbra">Zimbra</button>
        
    </div>
    <script>
       
        document.getElementById('btnMetodo').addEventListener('click', function() {
            const selectContainer = document.getElementById('selectContainer');
            selectContainer.style.display = selectContainer.style.display === 'none' || selectContainer.style.display === '' ? 'block' : 'none';
        });
    
        document.getElementById('metodos').addEventListener('change', function() {
            const selectedValue = this.value;
            const inputContainer = document.getElementById('inputContainer');
            inputContainer.innerHTML = ''; // Limpiar inputs anteriores
    
            if (selectedValue === 'metodo1') {
        const currentYear = new Date().getFullYear(); // Obtener el año actual
        const inputContainer = document.getElementById('inputContainer');
        inputContainer.innerHTML = `
        <div class="input-container">
             <div class="input-group">
                <label for="input1">UAI/M :</label>
                <textarea id="input1"  placeholder="" maxlength="1000" required onfocus="setInitialValue(this)" oninput="restrictInput(this)" ></textarea>
            </div>
        </div>
            <div class="input-group">
                <label for="input2">Para:</label>
                <textarea id="input2" placeholder="Ingrese Para" maxlength="1000" oninput="adjustTextareaHeight(this)"></textarea>
            </div>
            <div class="input-group">
                <label for="input3">Asunto:</label>
                <textarea id="input3" placeholder="Asunto" oninput="adjustTextareaHeight(this)"></textarea>
            </div>
        `;

            } else if (selectedValue === 'metodo2') {
                inputContainer.innerHTML = `
                    <label for="input3">Input para Memo 2:</label>
                    <input type="text" id="input3" placeholder="Ingrese dato A">
                `;
            } else if (selectedValue === 'metodo3') {
                inputContainer.innerHTML = `
                    <label for="input4">Input para Memo 3:</label>
                    <input type="text" id="input4" placeholder="Ingrese dato X">
                                    <input type="text" id="input5" placeholder="Ingrese dato Y">
                    <input type="text" id="input6" placeholder="Ingrese dato Z">
                `;
            }
        });



        const currentYear = new Date().getFullYear(); // Obtener el año actual
const initialMessage = `${currentYear}-`; // Mensaje que no se puede borrar
const maxLength = 8; // Longitud máxima permitida

function setInitialValue(textarea) {
    // Establecer el mensaje inicial si el textarea está vacío
    if (textarea.value === '') {
        textarea.value = initialMessage;
        textarea.selectionStart = textarea.value.length; // Colocar el cursor al final
    }
}

function restrictInput(textarea) {
    // Si el valor actual no comienza con el mensaje inicial, restablecerlo
    if (!textarea.value.startsWith(initialMessage)) {
        textarea.value = initialMessage; // Restablecer el mensaje inicial
    } else {
        // Extraer la parte numérica después del mensaje inicial
        const numbersPart = textarea.value.slice(initialMessage.length).replace(/[^0-9]/g, '');
        textarea.value = initialMessage + numbersPart; // Combinar el mensaje inicial con la parte numérica
    }

    // Limitar la longitud total a maxLength
    if (textarea.value.length > maxLength) {
        textarea.value = textarea.value.slice(0, maxLength); // Truncar el valor si excede la longitud máxima
    }
}

// Obtener el textarea y establecer el valor inicial al cargar la página
window.onload = function() {
    const textarea = document.getElementById('input1');
    setInitialValue(textarea);
};

// Obtener el textarea y establecer el valor inicial al cargar la página
window.onload = function() {
    const textarea = document.getElementById('input1');
    setInitialValue(textarea);
};

function checkInput(textarea) {
    // Si el contenido no comienza con el mensaje inicial, restaurarlo
    if (!textarea.value.startsWith(initialMessage)) {
        textarea.value = initialMessage; // Restaurar el mensaje inicial
        textarea.selectionStart = textarea.value.length; // Colocar el cursor al final
        textarea.selectionEnd = textarea.value.length; // Colocar el cursor al final
    }
}
function checkInput(textarea) {
    // Si el contenido no comienza con el mensaje inicial, restaurarlo
    if (!textarea.value.startsWith(initialMessage)) {
        textarea.value = initialMessage; // Restaurar el mensaje inicial
        textarea.selectionStart = textarea.value.length; // Colocar el cursor al final
        textarea.selectionEnd = textarea.value.length; // Colocar el cursor al final
    }
}

      
// Evento para el textarea
const input1 = document.getElementById('input1');
input1.value = initialValue; // Establecer el valor inicial al cargar la página

input1.addEventListener('input', function() {
    // Si el valor es diferente al valor inicial, restaurarlo
    if (!this.value.startsWith(initialValue)) {
        this.value = initialValue; // Restaurar el valor
    }

    // Permitir solo números después del valor inicial
    const numbersOnly = this.value.replace(initialValue, '').replace(/[^0-9]/g, '');
    this.value = initialValue + numbersOnly; // Restaurar el valor con solo números
});

        function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; // Restablecer la altura
        textarea.style.height = textarea.scrollHeight + 'px'; // Ajustar la altura al scrollHeight
    }

        // Función para validar el formato del input
        function validateInput(input) {
            // Validar que el input siga el formato AAAA-NNN
            const regex = /^\d{4}-\d{3}$/;
            if (!regex.test(input.value)) {
                input.setCustomValidity("Formato inválido. Debe ser AAAA-NNN.");
            } else {
                input.setCustomValidity("");
            }
        }

        // Evento para el botón "Descargar"
        document.getElementById('btnDescargar').addEventListener('click', function() {
            // Aquí puedes implementar la lógica para descargar un archivo
            alert('Funcionalidad de descarga no implementada aún.');
        });

        // Evento para el botón "Zimbra"
    document.getElementById('btnZimbra').addEventListener('click', function() {
    const selectedValue = document.getElementById('metodos').value; // Obtener el valor seleccionado
    const inputContainer = document.getElementById('inputContainer');
    
    // Obtener los valores de los inputs y textareas
    const inputs = inputContainer.querySelectorAll('input, textarea'); // Cambiado para incluir textarea
    let inputValues = {};
    
    inputs.forEach(input => {
        inputValues[input.id] = input.value; // Guardar el valor de cada input/textarea en un objeto
    });

    // Construir la URL con los parámetros
    const params = new URLSearchParams({
        metodo: selectedValue,
        ...inputValues // Añadir los valores de los inputs
    });

    // Redirigir a la URL con los parámetros
    window.location.href = `/gmail?${params.toString()}`; // Cambia '/gmail' por la ruta correcta
});
    </script>

    </x-section-basic>   
</div>