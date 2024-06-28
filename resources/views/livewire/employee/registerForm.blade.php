<div>
    @php
        // todo Get the public/js directory path and get the all of files
        $scripts = scandir(public_path('js/employee/registerFormScript'));
        $scripts = array_slice($scripts, 2, count($scripts) - 1);

        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10 w-full items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
        $title = 'Registro de personal';
    @endphp
    <x-button wire:click="$toggle('isOpened')">Registrar nuevo personal</x-button>

    <form wire:submit="save" enctype="multipart/form-data" method="POST" x-data="form()">
        <x-dialog-modal id="employee-register-form" maxWidth="md" wire:model="isOpened">
            <x-slot name="title">{{ $title }}</x-slot>

            <x-slot name="content">

                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-p00">P00:</label>
                    <input class="{{ $input }}" id="recipient-p00" name="p00" placeholder="155718" required
                        type="number" wire:model="p00" />
                </div>
                <div class="bg mb-3">
                    <label class="{{ $label }}" for="recipient-firstName">Primer Nombre:</label>
                    <input class="{{ $input }}" id="recipient-firstName" wire:model="first_name"
                        name="first_name" placeholder="JENBLUK" required type="text" x-model="firstName"
                        x-on:input="firstName = transformedInput(firstName)" />
                </div>
                <div class="mb-3">
                    <label for="recipient-secondSurname-checkbox">No aplica</label>
                    <input id="recipient-secondSurname-checkbox" type="checkbox"
                        x-on:change="{marked: markedSecondName, inputValue: secondName} = toggleMark(markedSecondName)" />
                    <br>
                    <label class="{{ $label }}" for="recipient-secondName">Segundo Nombre:</label>
                    <input wire:model="second_name" class="{{ $input }}" id="recipient-secondName"
                        name="second_name" type="text" x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                        x-bind:disabled="markedSecondName" x-bind:required="markedSecondName" x-model="secondName"
                        x-on:input="secondName = transformedInput(secondName)" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-firstSurname">Primer Apellido:</label>
                    <input wire:model="first_surname" class="{{ $input }}" id="recipient-firstSurname"
                        name="first_surname" placeholder="VANEGAS" required type="text" x-model="firstSurname"
                        x-on:input="firstSurname = transformedInput(firstSurname)" />
                </div>
                <div class="mb-3">
                    <label for="recipient-secondSurname-checkbox">No aplica</label>
                    <input id="recipient-secondSurname-checkbox" type="checkbox"
                        x-on:change="{marked: markedSecondSurname, inputValue: secondSurname} = toggleMark(markedSecondSurname)" />
                    <br>
                    <label class="{{ $label }}" for="recipient-secondSurname">Segundo Apellido:</label>
                    <input wire:model="second_surname" class="{{ $input }}" id="recipient-secondSurname"
                        name="second_surname" placeholder="GARCÍA" type="text"
                        x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''" x-bind:disabled="markedSecondSurname"
                        x-bind:required="markedSecondSurname" x-model="secondSurname"
                        x-on:input="secondSurname = transformedInput(secondSurname)" />
                </div>
                {{-- aqui falta el wire:model --}}

                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-personal_id">Cédula:</label>
                    <input class="{{ $input }}" id="recipient-personal_id" name="personal_id" required
                        type="text" x-model="value" x-on:input="value = updateValue(value)" wire:model="personal_id">
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-phoneNumber">Teléfono:</label>
                    <input wire:model="phone"
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        id="recipient-phoneNumber" name="phone" required type="tel" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-gmail">Correo UAI gmail:</label>
                    <input wire:model="gmail" class="{{ $input }}" id="recipient-gmail" name="gmail"
                        placeholder="jenblukvanegas@gmail.com" required type="email">
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-email_cantv">Correo Institucional:</label>
                    <input class="{{ $input }}" id="recipient-email_cantv" name="email_cantv"
                        placeholder="jvane01@cantv.com.ve" wire:model="email_cantv"
						type="email"
					>
				</div>
				<div class="mb-3">
					<label
						class="{{ $label }}"
						for="recipient-departament"
					>Coordinación o Gerencia de adscripción:</label>
					<select wire:model.change="uai"
					>
						@foreach ($uais as $uai)
							<option  value="{{ $uai->id }}">{{ $uai->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="mb-3">
					<label 
						class="{{ $label }}"
						for="recipient-job_title_id"
					>Cargo:</label>
					<select 
						class="{{ $input }}"
						id="recipient-job_title_id"
						name="job_title"
						required
						wire:model.change="job_title"

					>
					
						@foreach ($jobTitles as $jobTitle)
							<option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
							
						@endforeach
					</select>
				</div>
				<div>
					<div id="zona-carga"></div>
					<label for="photo">click para subir una imagen</label>
					<input
						accept="image/*"
						class="btn btn-primary mb-3"
						id="photo"
						name="photo"
						type="file"
						wire:model="photo"
					>
					<div class="mb-3">
						@error('photo')
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
			</x-slot>
			
			<x-slot name="footer">
				<x-secondary-button wire:click="resetComponent">cancelar</x-secondary-button>
				<x-button>guardar</x-button>
			</x-slot>
		</x-dialog-modal>
	</form>

	{{--  todo phone library *intlTelInput* --}}
	<script src="/js/intlTelInput/intlTelInput.js"></script>

	@foreach ($scripts as $script)
		<script 
		@if ($script != 'alpine.js')
			type="module" @endif
		src="/js/employee/registerFormScript/{{ $script }}">
                    </script>
                    @endforeach
                </div>
