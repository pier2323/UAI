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

  .iti {
    --iti-path-flags-1x: url('/images/flags/flags.png');
    --iti-path-globe-1x: url('/images/flags/globe.png');
    --iti-path-flags-2x: url('/images/flags/flags@2x.png');
    --iti-path-globe-2x: url('/images/flags/globe@2x.png');
  }

  .zona-carga-active {
    border: 1px dashed #ccc;
    text-align: center;
    padding: 20px;
    margin: 20px auto;
  }

  #zona-carga p {
    margin: 0;
  }

  #zona-carga img {
    width: 100%;
    height: auto;
    margin-top: 10px;
  }
  
  #zona-carga.hover {
    border-color: #007bff;
    /* Change border color to blue on hover */
    background-color: #e8f0fe;
    /* Add a subtle background color */
  }

  </style>

@php
  $label = 'col-form-label';
  $input = 'mb-5 mt-2 flex h-10 w-full items-center rounded border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none';
  @endphp

<x-modalBootstrap>
  <x-slot name=header>
    <div class="modal-header modal-header-2">
      <h1 class="modal-title font-bold fs-5" id="register">
        Registro del Personal
      </h1>
      <button type="button" class="btn-close absolute right-0 top-0 mr-5 mt-4 cursor-pointer rounded transition duration-150 ease-in-out hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-600" data-bs-dismiss="modal" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20"
          viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" />
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
      </button>
    </div>
  </x-slot>
  <form method="POST" action="{{ route('personal-uai.store') }}" x-data="form()">
      @csrf
      @method('POST')
      <div class="mb-3">
        <label for="recipient-p00" class="{{ $label }}">P00:</label>
        <input name="p00" type="number" class="{{ $input }}" id="recipient-p00" placeholder="155718" required />
      </div>
      <div class="mb-3 bg">
        <label for="recipient-firstName" class="{{ $label }}">Primer Nombre:</label>
        <input name="primer_nombre" id="recipient-firstName" type="text" class="{{ $input }}" placeholder="JENBLUK"
          x-on:input="firstName = transformedInput(firstName)" x-model="firstName" required />
      </div>
      <div class="mb-3">
        <label for="recipient-secondSurname-checkbox">No aplica</label>
        <input id="recipient-secondSurname-checkbox" type="checkbox"
        x-on:change="{marked: markedSecondName, inputValue: secondName} = toggleMark(markedSecondName)"
        />
        <br>
        <label for="recipient-secondName" class="{{ $label }}">Segundo Nombre:</label> 
        <input name="segundo_nombre" id="recipient-secondName" type="text" class="{{ $input }}"
          x-on:input="secondName = transformedInput(secondName)" {{-- * event  --}} 
          x-model="secondName"
          x-bind:class="markedSecondName ? 'bg-gray-200':''"
          x-bind:disabled="markedSecondName" {{-- * conditional  --}} 
          x-bind:required="markedSecondName" {{-- * conditional  --}} 
          />
      </div>
      <div class="mb-3">
        <label for="recipient-firstSurname" class="{{ $label }}">Primer Apellido:</label>
        <input name="primer_apellido" id="recipient-firstSurname" type="text" class="{{ $input }}" placeholder="VANEGAS"
          x-on:input="firstSurname = transformedInput(firstSurname)" x-model="firstSurname" required />
      </div>
      <div class="mb-3">
        <label for="recipient-secondSurname-checkbox">No aplica</label>
        <input id="recipient-secondSurname-checkbox" type="checkbox"
        x-on:change="{marked: markedSecondSurname, inputValue: secondSurname} = toggleMark(markedSecondSurname)" />
        <br>
        <label for="recipient-secondSurname" class="{{ $label }}">Segundo Apellido:</label> 
        <input name="segundo_apellido" id="recipient-secondSurname" type="text" class="{{ $input }}" placeholder="GARCÍA"
          x-bind:class="markedSecondSurname ? 'bg-gray-200':''"
          x-on:input="secondSurname = transformedInput(secondSurname)" x-model="secondSurname"  
          x-bind:disabled="markedSecondSurname" x-bind:required="markedSecondSurname" />
      </div>
      <div class="mb-3">
        <label for="recipient-cedula" class="{{ $label }}">Cédula:</label>
        <input name="cedula" id="recipient-cedula" type="text" class="{{ $input }}" x-model="value"
          x-on:input="value = updateValue(value)" required />
      </div>
      <div class="mb-3">
        <label for="recipient-phoneNumber" class="{{ $label }}">Teléfono:</label>
        <input name="telefono" type="tel" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="recipient-phoneNumber" required />
      </div>
      <div class="mb-3">
        <label for="recipient-gmail" class="{{ $label }}">Correo UAI gmail:</label>
        <input name="gmail" type="email" class="{{ $input }}" placeholder="jenblukvanegas@gmail.com" id="recipient-gmail" required>
      </div>
      <div class="mb-3">
        <label for="recipient-email_cantv" class="{{ $label }}">Correo Institucional:</label>
        <input name="email_cantv" type="email" class="{{ $input }}" placeholder="jvane01@cantv.com.ve" id="recipient-email_cantv">
      </div>
      <div class="mb-3">
        <label for="recipient-departament" class="{{ $label }}">Gerencia:</label>
        <select class="{{ $input }}" name="uai_id" id="recipient-departament" required>
          @foreach ($uais as $uai)
          <option value="{{ $uai->id }}">{{ $uai->nombre }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="recipient-cargo" class="{{ $label }}">Cargo:</label>
        <select class="{{ $input }}" name="cargo_id" id="recipient-cargo" required>
          @foreach ($cargos as $cargo)
          <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <div id="zona-carga"></div>
        <label for="recipient-foto_perfil">click para subir una imagen</label>
        <input name="foto_perfil" class="btn btn-primary mb-3" type="file" id="recipient-foto_perfil"
        accept="img/*">
      </div>
      
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        cerrar
      </button>
      <input type="submit" value="guardar" class="btn btn-primary" />
    </form>
  <div class="modal-footer-2">
  </div>
</x-modalBootstrap>

{{-- todo charge image --}}
<script>
  const zonaCarga = document.getElementById('zona-carga');
  const inputImagen = document.getElementById('recipient-foto_perfil');

  inputImagen.addEventListener('change', (e) => {
    zonaCarga.classList.toggle('zona-carga-active');
    const archivo = e.target.files[0];
    const reader = new FileReader();

    reader.onload = (e) => {
      const img = document.createElement('img');
      img.src = e.target.result;
      zonaCarga.innerHTML = '';
      zonaCarga.appendChild(img);
    };

    reader.readAsDataURL(archivo);
  });
</script>

{{-- todo phone library *intlTelInput* --}}
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

{{-- todo Alpine JS object --}}
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
      toggleMark: marked => {
        return {
          marked: !marked, 
          valueInput: '',
        }
      },
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

























{{-- 
<div class="absolute bottom-0 left-0 right-0 top-0 z-10 bg-gray-700 py-12 transition duration-150 ease-in-out"
  id="modal">
  <div role="alert" class="container mx-auto w-11/12 max-w-lg md:w-2/3">
    <div class="relative rounded border border-gray-400 bg-white px-5 py-8 shadow-md md:px-10"> --}}
      {{-- <div class="mb-3 flex w-full justify-start text-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52"
          height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
          stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" />
          <path
            d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
          <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
        </svg>
      </div> --}}
      {{-- <h1 class="font-lg mb-4 font-bold leading-tight tracking-normal text-gray-800">Enter Billing Details</h1>
      <label for="name" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Owner Name</label>
      <input id="name"
        class="mb-5 mt-2 flex h-10 w-full items-center rounded border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none"
        placeholder="James" />
      <label for="email2" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Card Number</label>
      <div class="relative mb-5 mt-2">
        <div class="absolute flex h-full items-center border-r px-4 text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="20"
            height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <rect x="3" y="5" width="18" height="14" rx="3" />
            <line x1="3" y1="10" x2="21" y2="10" />
            <line x1="7" y1="15" x2="7.01" y2="15" />
            <line x1="11" y1="15" x2="13" y2="15" />
          </svg>
        </div>
        <input id="email2"
          class="flex h-10 w-full items-center rounded border border-gray-300 pl-16 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none"
          placeholder="XXXX - XXXX - XXXX - XXXX" />
      </div>
      <label for="expiry" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Expiry Date</label>
      <div class="relative mb-5 mt-2">
        <div class="absolute right-0 flex h-full cursor-pointer items-center pr-3 text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="20"
            height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <rect x="4" y="5" width="16" height="16" rx="2" />
            <line x1="16" y1="3" x2="16" y2="7" />
            <line x1="8" y1="3" x2="8" y2="7" />
            <line x1="4" y1="11" x2="20" y2="11" />
            <rect x="8" y="15" width="2" height="2" />
          </svg>
        </div>
        <input id="expiry"
          class="flex h-10 w-full items-center rounded border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none"
          placeholder="MM/YY" />
      </div>
      <label for="cvc" class="text-sm font-bold leading-tight tracking-normal text-gray-800">CVC</label>
      <div class="relative mb-5 mt-2">
        <div class="absolute right-0 flex h-full cursor-pointer items-center pr-3 text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="20"
            height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"></path>
            <circle cx="12" cy="12" r="9"></circle>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
            <polyline points="11 12 12 12 12 16 13 16"></polyline>
          </svg>
        </div>
        <input id="cvc"
          class="mb-8 flex h-10 w-full items-center rounded border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none"
          placeholder="MM/YY" />
      </div>
      <div class="flex w-full items-center justify-start">
        <button
          class="rounded bg-indigo-700 px-8 py-2 text-sm text-white transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2">Submit</button>
        <button
          class="ml-3 rounded border bg-gray-100 px-8 py-2 text-sm text-gray-600 transition duration-150 ease-in-out hover:border-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
          onclick="modalHandler()">Cancel</button>
      </div>
      
    </div>
  </div>
</div>

<div class="flex w-full justify-center py-12" id="button">
  <button
    class="mx-auto rounded bg-indigo-700 px-4 py-2 text-xs text-white transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2 sm:px-8 sm:text-sm"
    onclick="modalHandler(true)">Open Modal</button>
</div> --}}
