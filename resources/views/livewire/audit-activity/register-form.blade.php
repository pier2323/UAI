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
    <x-button wire:click="$toggle('isOpened')">Registro</x-button>

    <x-dialog-modal id="employee-register-form" maxWidth="md" wire:model="isOpened">
        <x-slot name="title">{{ $title }}</x-slot>

        <x-slot name="content">
            <form enctype="multipart/form-data" method="POST" x-data="form()">
                <font size="5" style=" color: black;margin-left: 110px">
                    Datos del Saliente
                </font>
                @csrf
                @method('POST')
                <div class="mb-3">


                    <div class="bg mb-3">
                        <label class="{{ $label }}" for="recipient-firstName">Primer Nombre:</label>
                        <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                            type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                    </div>
                    <div class="mb-3">

                        <br>
                        <label class="{{ $label }}" for="recipient-secondName">Segundo Nombre:</label>
                        <input class="{{ $input }}" id="recipient-secondName" name="second_name" type="text"
                            x-bind:class="markedSecondName ? 'bg-gray-200' : ''" x-bind:disabled="markedSecondName"
                            x-bind:required="markedSecondName" x-model="secondName"
                            x-on:input="secondName = transformedInput(secondName)" />
                    </div>
                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-firstSurname">Primer Apellido:</label>
                        <input class="{{ $input }}" id="recipient-firstSurname" name="first_surname" required
                            type="text" x-model="firstSurname"
                            x-on:input="firstSurname = transformedInput(firstSurname)" />
                    </div>
                    <div class="mb-3">
                        <br>
                        <label class="{{ $label }}" for="recipient-secondSurname">Segundo Apellido:</label>
                        <input class="{{ $input }}" id="recipient-secondSurname" name="second_surname"
                            type="text" x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
                            x-bind:disabled="markedSecondSurname" x-bind:required="markedSecondSurname"
                            x-model="secondSurname" x-on:input="secondSurname = transformedInput(secondSurname)" />
                    </div>
                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-personal_id">Cédula:</label>
                        <input class="{{ $input }}" id="recipient-personal_id" name="personal_id" required
                            type="text" x-model="value" x-on:input="value = updateValue(value)" />
                    </div>
                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-phoneNumber">Teléfono:</label>
                        <input
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            id="recipient-phoneNumber" name="phone" required type="tel" />
                    </div>
                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-gmail">Correo Eletronico :</label>
                        <input class="{{ $input }}" id="recipient-gmail" name="gmail" required type="email">
                    </div>
                    <div class="mb-3">
                        <label class="{{ $label }}" for="recipient-email_cantv">Correo Institucional:</label>
                        <input class="{{ $input }}" id="recipient-email_cantv" name="email_cantv"
                            type="email">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Gerencia </label>
                        <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                            type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Direción </label>
                        <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                            type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                    </div>
                    <font size="5" style=" color: black;margin-left: 110px">
                        Datos del Entrante
                    </font>
                </div>
                <div class="bg mb-3">
                    <label class="{{ $label }}" for="recipient-firstName">Primer Nombre:</label>
                    <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                        type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                </div>
                <div class="mb-3">

                    <br>
                    <label class="{{ $label }}" for="recipient-secondName">Segundo Nombre:</label>
                    <input class="{{ $input }}" id="recipient-secondName" name="second_name" type="text"
                        x-bind:class="markedSecondName ? 'bg-gray-200' : ''" x-bind:disabled="markedSecondName"
                        x-bind:required="markedSecondName" x-model="secondName"
                        x-on:input="secondName = transformedInput(secondName)" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-firstSurname">Primer Apellido:</label>
                    <input class="{{ $input }}" id="recipient-firstSurname" name="first_surname" required
                        type="text" x-model="firstSurname"
                        x-on:input="firstSurname = transformedInput(firstSurname)" />
                </div>
                <div class="mb-3">

                    <br>
                    <label class="{{ $label }}" for="recipient-secondSurname">Segundo Apellido:</label>
                    <input class="{{ $input }}" id="recipient-secondSurname" name="second_surname"
                        type="text" x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
                        x-bind:disabled="markedSecondSurname" x-bind:required="markedSecondSurname"
                        x-model="secondSurname" x-on:input="secondSurname = transformedInput(secondSurname)" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-personal_id">Cédula:</label>
                    <input class="{{ $input }}" id="recipient-personal_id" name="personal_id" required
                        type="text" x-model="value" x-on:input="value = updateValue(value)" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-phoneNumber">Teléfono:</label>
                    <input class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        id="recipient-phoneNumber" name="phone" required type="tel" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-gmail">Correo Eleronico:</label>
                    <input class="{{ $input }}" id="recipient-gmail" name="gmail" required type="email">
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-email_cantv">Correo Institucional:</label>
                    <input class="{{ $input }}" id="recipient-email_cantv" name="email_cantv"
                        type="email">
                </div>
                <label class="{{ $label }}" for="recipient-email_cantv">Gerencia:</label>
                <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                    type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Gerencia </label>
                    <input class="{{ $input }}" id="recipient-firstName" name="first_name" required
                        type="text" x-model="firstName" x-on:input="firstName = transformedInput(firstName)" />
                </div>
                <div class="mb-3">
                    <label class="{{ $label }}" for="recipient-email_cantv">Fecha de
                        Sucripcion:</label>
                    <input class="{{ $input }}" type="date" name="date" id="dateIni"
                        value="2024-05-09" min="2016-04-27" max="3000-05-09" class="form-control" />
                </div>

            </form>
        </x-slot>


        <x-slot name="footer">
            <x-secondary-button wire:click="resetComponent">cancelar</x-secondary-button>
            <x-button>guardar</x-button>
        </x-slot>
    </x-dialog-modal>

    {{--  todo phone library *intlTelInput* --}}
    <script src="/js/intlTelInput/intlTelInput.js"></script>

    @foreach ($scripts as $script)
        <script @if ($script != 'alpine.js') type="module" @endif
            src="/js/employee/registerFormScript/{{ $script }}"></script>
    @endforeach
</div>

</div>
