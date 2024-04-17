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
  $input = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
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
            <input type="number" class="{{ $input }}" id="recipient-p00" required/>
          </div>
          <div class="mb-3">
            <label for="recipient-firstName" class="{{ $label }}">Primer Nombre:</label>
            <input 
              id="recipient-firstName" 
              type="text" 
              class="{{ $input }}"
              x-on:input="firstName = transformedInput(firstName)" 
              x-model="firstName" 
              required
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
              x-on:input="secondName = transformedInput(secondName)" {{-- * event  --}}
              x-model="secondName" 
              x-bind:disabled="markedSecondName" {{-- * conditional  --}}
              x-bind:required="markedSecondName" {{-- * conditional  --}}
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
              required
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
              x-bind:required="markedSecondSurname"
            />
          </div>
          <div class="mb-3">
            <label for="recipient-cedula" class="{{ $label }}">Cédula:</label>
            <input 
              id="recipient-cedula"
              type="text"
              class="{{ $input }}"
              x-model="value"
              x-on:input="value = updateValue(value)"
              required
            />
          </div>
          <div class="mb-3">
            <label for="recipient-phoneNumber" class="{{ $label }}">Teléfono:</label>
            <input
             type="tel" 
             class="{{ $input }}" 
             id="recipient-phoneNumber" 
             required
            />
          </div>
          <div class="mb-3">
            <label for="recipient-gmail" class="{{ $label }}">Correo UAI gmail:</label>
            <input 
              type="email" 
              class="{{ $input }}" 
              id="recipient-gmail"
              required
            >
          </div>
          <div class="mb-3">
            <label for="recipient-email_cantv" class="{{ $label }}">Correo Institucional:</label>
            <input 
              type="email" 
              class="{{ $input }}" 
              id="recipient-email_cantv"
            >
          </div>
          <div class="mb-3">
            <label for="recipient-gerencia" class="{{ $label }}">Gerencia:</label>
            <select class="{{$input}}" name="gerencia" id="recipient-gerencia" required>
              @foreach ($uais as $uai)
                <option value="{{$uai->id}}">{{$uai->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-cargo" class="{{ $label }}">Cargo:</label>
            <select class="{{$input}}" name="cargo" id="recipient-cargo" required>
              @foreach ($cargos as $cargo)
                <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                @endforeach
              </select>
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
    value: 'V-',

    // functions
    transformedInput: input => input.replace(/\s/g, '').toUpperCase(),
    toggleMark: marked => marked = !marked,
    updateValue: value => {
      // Agregar "V-" al principio
      if (!value.startsWith('V-') === true || value == 'V') return 'V-';

      // Limitar a 8 dígitos
      if (value.length > 8) return value.slice(0, 10);
      
      return value
    },
  }
}
</script>
