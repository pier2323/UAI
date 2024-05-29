<link
	href="/css/modal_uai.css"
	rel="stylesheet"
>
@php
	$label = "col-form-label";
	$input =
	    "mb-5 mt-2 flex h-10 w-full items-center rounded border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-700 focus:outline-none";
@endphp

<x-modalBootstrap>
	<x-slot name=header>
		<div class="modal-header modal-header-2">
			<h1
				class="modal-title fs-5 font-bold"
				id="register"
			>
				Registro del Personal
			</h1>
			<button
				aria-label="Close"
				class="btn-close absolute right-0 top-0 mr-5 mt-4 cursor-pointer rounded transition duration-150 ease-in-out hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-600"
				data-bs-dismiss="modal"
				type="button"
			>
				<svg
					class="icon icon-tabler icon-tabler-x"
					fill="none"
					height="20"
					stroke-linecap="round"
					stroke-linejoin="round"
					stroke-width="2.5"
					stroke="currentColor"
					viewBox="0 0 24 24"
					width="20"
					xmlns="http://www.w3.org/2000/svg"
				>
					<path
						d="M0 0h24v24H0z"
						stroke="none"
					/>
					<line
						x1="18"
						x2="6"
						y1="6"
						y2="18"
					/>
					<line
						x1="6"
						x2="18"
						y1="6"
						y2="18"
					/>
				</svg>
			</button>
		</div>
	</x-slot>
	<form
		action="{{ route("personal-uai.store") }}"
		enctype="multipart/form-data"
		method="POST"
		x-data="form()"
	>
		@csrf
		@method("POST")
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-p00"
			>P00:</label>
			<input
				class="{{ $input }}"
				id="recipient-p00"
				name="p00"
				placeholder="155718"
				required
				type="number"
			/>
		</div>
		<div class="bg mb-3">
			<label
				class="{{ $label }}"
				for="recipient-firstName"
			>Primer Nombre:</label>
			<input
				class="{{ $input }}"
				id="recipient-firstName"
				name="primer_nombre"
				placeholder="JENBLUK"
				required
				type="text"
				x-model="firstName"
				x-on:input="firstName = transformedInput(firstName)"
			/>
		</div>
		<div class="mb-3">
			<label for="recipient-secondSurname-checkbox">No aplica</label>
			<input
				id="recipient-secondSurname-checkbox"
				type="checkbox"
				x-on:change="{marked: markedSecondName, inputValue: secondName} = toggleMark(markedSecondName)"
			/>
			<br>
			<label
				class="{{ $label }}"
				for="recipient-secondName"
			>Segundo Nombre:</label>
			<input
				{{-- * event  --}}
				{{-- * conditional  --}}
				{{-- * conditional  --}}
				class="{{ $input }}"
				id="recipient-secondName"
				name="segundo_nombre"
				type="text"
				x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
				x-bind:disabled="markedSecondName"
				x-bind:required="markedSecondName"
				x-model="secondName"
				x-on:input="secondName = transformedInput(secondName)"
			/>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-firstSurname"
			>Primer Apellido:</label>
			<input
				class="{{ $input }}"
				id="recipient-firstSurname"
				name="primer_apellido"
				placeholder="VANEGAS"
				required
				type="text"
				x-model="firstSurname"
				x-on:input="firstSurname = transformedInput(firstSurname)"
			/>
		</div>
		<div class="mb-3">
			<label for="recipient-secondSurname-checkbox">No aplica</label>
			<input
				id="recipient-secondSurname-checkbox"
				type="checkbox"
				x-on:change="{marked: markedSecondSurname, inputValue: secondSurname} = toggleMark(markedSecondSurname)"
			/>
			<br>
			<label
				class="{{ $label }}"
				for="recipient-secondSurname"
			>Segundo Apellido:</label>
			<input
				class="{{ $input }}"
				id="recipient-secondSurname"
				name="segundo_apellido"
				placeholder="GARCÍA"
				type="text"
				x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
				x-bind:disabled="markedSecondSurname"
				x-bind:required="markedSecondSurname"
				x-model="secondSurname"
				x-on:input="secondSurname = transformedInput(secondSurname)"
			/>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-cedula"
			>Cédula:</label>
			<input
				class="{{ $input }}"
				id="recipient-cedula"
				name="cedula"
				required
				type="text"
				x-model="value"
				x-on:input="value = updateValue(value)"
			/>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-phoneNumber"
			>Teléfono:</label>
			<input
				class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
				id="recipient-phoneNumber"
				name="telefono"
				required
				type="tel"
			/>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-gmail"
			>Correo UAI gmail:</label>
			<input
				class="{{ $input }}"
				id="recipient-gmail"
				name="gmail"
				placeholder="jenblukvanegas@gmail.com"
				required
				type="email"
			>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-email_cantv"
			>Correo Institucional:</label>
			<input
				class="{{ $input }}"
				id="recipient-email_cantv"
				name="email_cantv"
				placeholder="jvane01@cantv.com.ve"
				type="email"
			>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-departament"
			>Gerencia:</label>
			<select
				class="{{ $input }}"
				id="recipient-departament"
				name="uai_id"
				required
			>
				@foreach ($uais as $uai)
					<option value="{{ $uai->id }}">{{ $uai->nombre }}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label
				class="{{ $label }}"
				for="recipient-cargo"
			>Cargo:</label>
			<select
				class="{{ $input }}"
				id="recipient-cargo"
				name="cargo_id"
				required
			>
				@foreach ($cargos as $cargo)
					<option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
				@endforeach
			</select>
		</div>
		<div>
			<div id="zona-carga"></div>
			<label for="recipient-foto_perfil">click para subir una imagen</label>
			<input
				accept="image/*"
				class="btn btn-primary mb-3"
				id="recipient-foto_perfil"
				name="foto_perfil"
				type="file"
			>
			<div class="mb-3">
				@error("foto_perfil")
					<div
						class="relative rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
						role="alert"
					>
						<strong class="font-bold">Error!</strong>
						<span class="block sm:inline">{{ $message }}</span>
						<span class="absolute bottom-0 right-0 top-0 px-4 py-3">
							<svg
								class="h-6 w-6 fill-current text-red-500"
								role="button"
								viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg"
							>
								<title>Close</title>
								<path
									d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
								/>
							</svg>
						</span>
					</div>
				@enderror
			</div>
		</div>
		<button
			class="btn btn-secondary"
			data-bs-dismiss="modal"
			type="button"
		>
			cerrar
		</button>
		<input
			class="btn btn-primary"
			type="submit"
			value="guardar"
		/>
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

<livewire:Modal />

