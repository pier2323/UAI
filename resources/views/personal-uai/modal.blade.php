<style>
  .modal-header-2 {
    background-image: url("/images/template/cantv.png");
    background-size: cover;
    color: #fff;
  }

  .modal-footer-2 {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #modalBody-centro {
    overflow: auto;
    height: 70vh;
    scroll-behavior: auto
  }

  #exampleModal {
    overflow: hidden;
  }

.iti {
  --iti-path-flags-1x: url('/images/flags/flags.png');
  --iti-path-globe-1x: url('/images/flags/globe.png');
  --iti-path-flags-2x: url('/images/flags/flags@2x.png');
  --iti-path-globe-2x: url('/images/flags/globe@2x.png');
}
</style>

@php
  $label = 'col-form-label';
  $input = 'form-control';
@endphp

<div class="modal fade" id="Modal-UAI" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">
          Registro del Personal
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="modalBody-centro" class="modal-body">
        <form x-data="form()">
          <div class="mb-3">
            <label for="recipient-p00" class="{{ $label }}">P00:</label>
            <input type="number" class="{{ $input }}" id="recipient-p00" />
          </div>
          <div class="mb-3">
            <label for="recipient-firstName" class="{{ $label }}">Primer Nombre:</label>
            <input 
              id="recipient-firstName" 
              type="text" 
              class="{{ $input }}"
              x-on:input="firstName = transformedInput(firstName)" 
              x-model="firstName" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-secondSurname-checkbox">No aplica</label>
            <input
              id="recipient-secondSurname-checkbox"
              type="checkbox"
              x-on:change="markedSecondName = toggleMark(markedSecondName)"
            />
            <label for="recipient-secondName" class="{{ $label }}">Segundo Nombre:</label>
            <input 
              id="recipient-secondName" 
              type="text" 
              class="{{ $input }}"
              x-bind:disabled="markedSecondName" {{-- * conditional  --}}
              x-on:input="secondName = transformedInput(secondName)" {{-- * event  --}}
              x-model="secondName" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-firstSurname" class="{{ $label }}">Primer Apellido:</label>
            <input 
              id="recipient-firstSurname" 
              type="text" 
              class="{{ $input }}"
              x-on:input="firstSurname = transformedInput(firstSurname)" 
              x-model="firstSurname" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-secondSurname-checkbox">No aplica</label>
            <input
              id="recipient-secondSurname-checkbox"
              type="checkbox"
              x-on:change="markedSecondSurname = toggleMark(markedSecondSurname)"
            />
            <label for="recipient-secondSurname" class="{{ $label }}">Segundo Apellido:</label>
            <input 
              id="recipient-secondSurname"
              type="text"
              class="{{ $input }}"
              x-on:input="secondSurname = transformedInput(secondSurname)" 
              x-model="secondSurname"
              x-bind:disabled="markedSecondSurname" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="{{ $label }}">Cédula:</label>
            <input 
              id="recipient-cedula"
              type="text" 
              class="{{ $input }}" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-phoneNumber" class="{{ $label }}">Teléfono:</label>
            <input
             type="tel" 
             class="{{ $input }}" 
             id="recipient-phoneNumber" 
            />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="{{ $label }}">Correo Institucional:</label>
            <input type="text" class="{{ $input }}" id="recipient-email_cantv">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="{{ $label }}">Gerencia:</label>
            <input type="text" class="{{ $input }}" id="recipient-cedula" />
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="{{ $label }}">Cargo:</label>
            <input type="text" class="{{ $input }}" id="recipient-cedula" />
          </div>
        </form>
      </div>
      <div class="modal-footer-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          cerrar
        </button>
        <button type="button" class="btn btn-primary">guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="/js/intlTelInput/intlTelInput.js"></script>
<script type="module">
  
import es from "/js/intlTelInput/es/index.mjs";
const $phoneNumber = document.querySelector("#recipient-phoneNumber");

window.intlTelInput($phoneNumber, {
  i18n: es,
  utilsScript: "/js/intlTelInput/utils.js",
  initialCountry: "ve",
  nationalMode: false,
});

</script>
<script>
function form() {
  return {
    firstName: null,
    secondName: null,
    markedSecondName: false,
    firstSurname: null,
    secondSurname: null,
    markedSecondSurname: false,
    labelPhoneNumber: null,

    // functions
    transformedInput: input => input.replace(/\s/g, '').toUpperCase(),
    toggleMark: marked => marked = !marked,
    phoneNumber: (iti) => {
      let text;
      if (input.value) {
        text = iti.isValidNumber() ? 
          "Valid number! Full international format: " + iti.getNumber()
          : "Invalid number - please try again";
        } else {
          text = "Please enter a valid number below";
        }
        const textNode = document.createTextNode(text);
        output.innerHTML = "";
        output.appendChild(textNode);
      },
    }
}
</script>
