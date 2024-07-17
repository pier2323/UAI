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
                    @error('p00')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-p00">P00:</label>

                        <div class="flex">

                            <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                style="margin-top: 10px;">
                                P00</div>

                            <p class="font-extrabold block p-2" style="margin-top: 10px">-</p>
                            <input id="recipient-p00" name="p00" class="{{ $input }}" id="recipient-p00"
                                name="personal_id" placeholder="155718" id="recipient-p00" name="p00" type="text"
                                x-model="$wire.p00" x-on:input="$wire.p00 = updatep00($wire.p00)" wire:model="p00"
                                required>
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    @error('first_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="bg mb-3">
                        <label class="{{ $label }}" for="recipient-firstName">Primer Nombre:</label>
                        <input class="{{ $input }}" id="recipient-firstName" wire:model="first_name"
                            name="first_name" placeholder="JENBLUK" type="text" x-model="$wire.first_name"
                            x-on:input="$wire.first_name = transformedInput($wire.first_name)" required />
                    </div>
                </div>

                <div class="mb-3">


                    @error('second_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <label class="{{ $label }}" for="recipient-secondName">Segundo Nombre:</label>
                    <input wire:model="second_name" class="{{ $input }}" id="recipient-secondName"
                        name="second_name" type="text" x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                        x-bind:disabled="markedSecondName" x-bind:required="markedSecondName"
                        x-model="$wire.second_name"
                        x-on:input="$wire.second_name = transformedInput($wire.second_name)" />
                </div>


                @error('first_surname')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-firstSurname">Primer Apellido:</label>
                    <input wire:model="first_surname" class="{{ $input }}" id="recipient-firstSurname"
                        name="first_surname" placeholder="VANEGAS" type="text" x-model="$wire.first_surname"
                        x-on:input="$wire.first_surname = transformedInput($wire.first_surname)" required />
                </div>
                <div class="mb-3">


                    @error('second_surname')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <label class="{{ $label }}" for="recipient-secondSurname">Segundo Apellido:</label>
                    <input wire:model="second_surname" class="{{ $input }}" id="recipient-secondSurname"
                        name="second_surname" placeholder="GARCÍA" type="text"
                        x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''" x-bind:disabled="markedSecondSurname"
                        x-bind:required="markedSecondSurname" x-model="$wire.second_surname"
                        x-on:input="$wire.second_surname = transformedInput($wire.second_surname)" />
                </div>
                {{-- aqui falta el wire:model --}}

                <div class="mb-3">
                    @error('personal_id')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <label class="{{ $label }}" for="recipient-personal_id">Cédula:</label>

                    <div class="flex">

                        <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                            style="margin-top: 10px;">
                            V</div>

                        <p class="font-extrabold block p-2" style="margin-top: 10px">-</p>
                        <input id="personal_id" name="personal_id" class="{{ $input }}" type="text"
                            x-model="personalId" x-on:input="personalId= updateValue(personalId)"
                            wire:model="personal_id" required>
                    </div>
                </div>

                <div class="mb-3">
                    @error('phone_number')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    {{-- ! termidar de conbinar el 0412 con los demas numeros   --}}
                    <div class="mb-3">
                        <label class="{{ $label }}" for="phoner">Teléfono:</label>
                        <div class="flex">
                        
                                <select id="listaTelefonos" name="phone_number" class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                name="phone_code" id="phone_code" style="margin-top: 10px;" wire:model="phone_code">
                                    <option value="">Seleccione</option>
                                    <option value="0412">0412</option>
                                    <option value="0414">0414</option>
                                    <option value="0416">0416</option>
                                    <option value="0424">0424</option>
                                    <option value="0426">0426</option>
                                  </select>
                                  
                                  <script>
                                    const listaTelefonos = document.getElementById('listaTelefonos');
                                    const opcionPredeterminada = listaTelefonos.querySelector('option[value=""]');
                                  
                                    listaTelefonos.addEventListener('click', function() {
                                      if (this.value !== "") {
                                        opcionPredeterminada.disabled = true;
                                      } else {
                                        opcionPredeterminada.disabled = false;
                                      }
                                    });
                                  </script>
                                  
                                  
                            
                            <p class="font-extrabold block p-2" style="margin-top: 10px">-</p>

                            <input id="phoneNumber" class="{{ $input }}" name="phone_number" type="tel"
                                x-model="phone" x-on:input="phone=updatephone(phone)" wire:model="phone_number"
                                required>

                        </div>
                    </div>
                </div>
                @error('gmail')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-gmail">Correo UAI gmail:</label>
                    <input wire:model="gmail" class="{{ $input }}" id="gmail" name="gmail"
                        placeholder="jenblukvanegas@gmail.com"type="email" required>
                </div>
                <div class="mb-3">
                    @error('email_cantv')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <label class="{{ $label }}" for="recipient-email_cantv">Correo Institucional:</label>
                    <input class="{{ $input }}" id="recipient-email_cantv" name="email_cantv"
                        placeholder="jvane01@cantv.com.ve" wire:model="email_cantv"
						type="email"
					>
				</div>
				<div class="mb-3">
                    @error('uai')
                    <span class="text-red-500">{{ $message }}</span>
                 @enderror
					<label
                    class="{{ $label }}"
                    for="recipient-departament"
					>Coordinación o Gerencia de adscripción:</label>
					<select wire:model.change="uai"
                    x-on:click="uaiTried = true"
                    class="{{ $input }}"
                    required
                    >
					    <option class="{{ $input }}"  x-bind:selected="uaiTried"  x-bind:disabled="uaiTried" >Elige una coordinación...</option>
						@foreach ($uais as $uai)
                        <option class="{{ $input }}" value="{{ $uai->id }}">{{ $uai->name }}</option>
						@endforeach
                    </select>
				</div>
				<div class="mb-3">
                    @error('job_title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
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
						x-on:click="jobTitleTried = true"
					>
                    @error('jobTitle')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
					<option class="{{ $input }}" x-bind:selected="jobTitleTried" x-bind:disabled="jobTitleTried">Elige un cargo...</option>
						@foreach ($jobTitles as $jobTitle)
							<option value="{{ $jobTitle->id }}">{{ $jobTitle->name }}</option>
						@endforeach
					</select>
				</div>
				<div>
                    @error('photo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
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
								role="alert"required
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
            
                     
                     <x-button  style="background-color:rgb(234, 81, 81); margin-left: 160px; margin-right: 10px;" type="button" wire:click="limpiar">limpiar</x-button>
                     <x-button  style="background-color: rgba(1, 150, 125, 0.644);  " type="button" wire:click="validar" > Validar </x-button>
                 
          
                    {{-- todo All Erros --}}

                 @if ($valido == 1)            
                    <div class="bg-teal-100 border-t-4 mt-3 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                     <strong class="font-bold">Todo OK!</strong>
                     <br>
                        <span class="block sm:inline">Todos los campos del <strong>Ingreso del Personal</strong> han sido escritos correctamente.</span>
                    </div>
                @elseif ($valido == 2)
                    <div class="bg-red-100 border mt-3 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                            <br>
                        <ul>
                             @foreach ($errors->all() as $error)
                                <li>
                                    <span class="block sm:inline">{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                 @endif

			</x-slot>
			
            
			<x-slot name="footer">
				<x-secondary-button 
                wire:click="resetComponent"  style="margin-right: 10px;" id="cancelar">cancelar</x-secondary-button>
				<x-button wire:submit>guardar</x-button>
			</x-slot>
            
		</x-dialog-modal>
 
 




	{{--  todo phone library *intlTelInput* --}}





	@foreach ($scripts as $script)
		<script 
  
		@if ($script != 'alpine.js')
    
			type="module" @endif
		src="/js/employee/registerFormScript/{{ $script }}">
                    </script>
                    @endforeach
                </div>
