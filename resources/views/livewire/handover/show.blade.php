<div>
    {{-- @dump($auditActivity) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
    @endphp
    <x-section-basic>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="px-4 py-2">
                        <section
                            class="container mx-auto flex flex-col justify-center px-8 py-3 align-middle sm:flex-row-reverse sm:px-12">
                            <div style=" border-radius: 20px" class="border-slate-500">

                            </div>
                            <div class="border- mr-4 w-full text-left  sm:w-1/2 sm:text-left">
                                <ul class="mb-8 flex flex-col items-left space-y-1 dark:text-slate-400 sm:items-start">

                                    </li>
                                    <li>
                                        <p style="margin-left: -200px;" class="text-gray-600"> Descripción: </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->description }}
                                    </li>

                                    <li>
                                        <p style="margin-left: -200px;margin-top: 20px;" class="text-gray-600"> Codigó
                                            de la Actuación: </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->code }}
                                        </p>
                                    </li>
                                    <li>
                                        <p style="margin-left: -200px;margin-top: 20px;" class="text-gray-600"> Tipo de
                                            Actuación: </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->typeAudit->name }}
                                        </p>
                                    </li>
                                    <li>
                                        <p style="margin-left: -200px;margin-top: 20px;" class="text-gray-600"> Gerencia
                                            adscrita: </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->departament_id }}
                                        </p>

                                        </p>
                                    </li>
                                    <li>
                                        <p style="margin-left: -200px;margin-top: 20px;" class="text-gray-600"> Mes de
                                            inicio </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->month_start }}
                                        </p>
                                    </li>
                                    <li>
                                        <p style="margin-left: -200px;margin-top: 20px;" class="text-gray-600"> Mes de
                                            fin </p>
                                        <p style="margin-left: -200px;padding-right: 260px;color: black;">
                                            {{ $auditActivity->month_end }}
                                        </p>
                                    </li>


                                    <li>
                                        <p style="text-align: right; margin-top: -415px;margin-left: 580px;"
                                            class="text-gray-600"> Comision: </p>
                                        <h1 style="text-align: right;margin-left: 300px;color: black;">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, omnis
                                            ducimus! Odit laudantium totam dolore explicabo. Illum ex tenetur laboriosam
                                            debitis est, tempore doloremque ipsam. Voluptas earum odit laudantium.
                                            Voluptas.
                                        </h1>

                                    </li>


                                </ul>

                                <br>
                                <br>

                                <div class="carta">

                                    <div>
                                        <h1 class="texto-mit" style="margin-left:450px;padding-top: 20px;">
                                            Datos
                                        </h1>
                                    </div>

                                    <br>
                                </div>

                                <style>
                                    .carta {
                                        background-color: #eaeaea;
                                        /* Color de fondo inicial */
                                        border-radius: 10px;
                                        /* Redondea las esquinas */
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                        /* Sombra sutil */
                                        transition: background-color 0.3s ease;
                                        /* Transición suave al cambiar de color */
                                        margin-left: -300px;
                                        margin-right: -323px;
                                    }

                                    .carta:hover {
                                        background-color: #e0e0e0;
                                        /* Color de fondo al pasar el cursor */
                                    }
                                </style>

                                <div class="texto-degradado-izquierda">
                                    <p>Saliente</p>
                                </div>

                                <p class="texto-degradado-derecha"> Entrante </p>

                                <style>
                                    .titulo-degradado {
                                        font-size: 1.5rem;
                                        text-align: center;
                                        background: linear-gradient(45deg, #f2711c, #e94058, #8e2de2);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        background-clip: text;
                                        text-fill-color: transparent;

                                    }


                                    .texto-degradado-derecha {
                                        font-size: 1.5rem;
                                        text-align: right;
                                        /* Alinea el texto a la derecha */
                                        background: linear-gradient(to left, #e94058, #8e2de2);
                                        /* Degradado de derecha a izquierda */
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        background-clip: text;
                                        text-fill-color: transparent;
                                        margin-top: -30px;
                                    }


                                    .texto-degradado-izquierda {
                                        margin-left: -200px;
                                        margin-top: 20px;
                                        font-size: 1.5rem;
                                        background: linear-gradient(to right, #e94058, #8e2de2);
                                        /* Degradado de izquierda a derecha */
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        background-clip: text;
                                        text-fill-color: transparent
                                    }


                                    .texto-grande {
                                        font-size: 2rem;
                                        /* Ajusta el tamaño según tus necesidades */
                                        background: linear-gradient(to right, black, rgb(5, 5, 249));
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        margin-left: -250px;
                                    }

                                    .texto-mit {
                                        font-size: 1.5rem;
                                        text-align: center;
                                        background: linear-gradient(45deg, #f2711c, #e94058, #8e2de2);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                        background-clip: text;
                                        text-fill-color: transparent;
                                        margin-left: 450px;
                                        padding-top: 20px;
                                        margin-right: 550px;
                                    }


                                    .texto-derecha {
                                        text-align: right;
                                        margin-left: 580px;
                                        font-size: 2rem;
                                        /* Ajusta el tamaño según tus necesidades */
                                        background: linear-gradient(to right, black, rgb(5, 5, 249));
                                        -webkit-background-clip: text;
                                        margin-top: -40px
                                    }
                                </style>
                                {{-- Saliente --}}
                                <div class="carta2">
                                    <form action="salve" method="GET" x-data""
                                        style="margin-left: -200px;margin-top: 100px;">

                                        <div class="mb-3">
                                            <label class="{{ $label }}" for="recipient-p00">P00:</label>

                                            <div class="flex">

                                                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                    style="margin-top: 10px;">
                                                    P00</div>
                                                <p class="font-extrabold block p-2" style="margin-top: 10px">-</p>
                                                <input id="recipient-p00" name="p00" class="{{ $input }}"
                                                    name="personal_id" placeholder="155718" type="text"
                                                    x-model="$wire.p00" {{--  x-on:input="$wire.p00 = updatep00($wire.p00)" wire:model="p00" --}} required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="{{ $label }}" for="outgoing.personal_id">Numero de
                                                Cedula:</label>
                                            <x-input-error for='outgoing.personal_id' />
                                            <div class="flex">
                                                <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                    style="margin-top: 10px;">V</div>

                                                <p class="font-extrabold block p-2">-</p>
                                                <input id="outgoing.personal_id" name="outgoing.personal_id"
                                                    {{-- required --}} class="{{ $input }}" type="text"
                                                    x-on:input="$wire.outgoing.personal_id = updateValue($wire.outgoing.personal_id, 6)"
                                                    x-model="$wire.outgoing.personal_id"
                                                    wire:model.defer="outgoing.personal_id">
                                            </div>
                                        </div>

                                        {{-- todo first_name --}}
                                        <div class="bg mb-3">
                                            <label class="{{ $label }}" for="outgoing.first_name">Primer
                                                Nombre:</label>
                                            <x-input-error for='outgoing.first_name' />
                                            <input id="outgoing.first_name" wire:model="outgoing.first_name"
                                                class="{{ $input }}" name="outgoing.first_name"
                                                placeholder="JENBLUK" type="text" x-model="$wire.outgoing.first_name"
                                                x-on:input="$wire.outgoing.first_name = transformedInput($wire.outgoing.first_name)" />
                                        </div>

                                        {{-- todo second_name --}}
                                        <div class="mb-3">
                                            <label class="{{ $label }}" for="outgoing.second_name">Segundo
                                                Nombre:</label>
                                            <x-input-error for='outgoing.second_name' />
                                            <input id="outgoing.second_name" class="{{ $input }}"
                                                name="outgoing.second_name" type="text"
                                                x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                                                x-bind:disabled="markedSecondName" x-bind:required="markedSecondName"
                                                x-model="$wire.outgoing.second_name"
                                                x-on:input="$wire.outgoing.second_name = transformedInput($wire.outgoing.second_name)"
                                                wire:model="outgoing.second_name" />

                                            {{-- todo button No Aplica --}}
                                            <div>

                                            </div>

                                            {{-- todo first_surname --}}
                                            <div class="mb-3">
                                                <label class="{{ $label }}" for="outgoing.first_surname">Primer
                                                    Apellido:</label>
                                                <x-input-error for='outgoing.first_surname' />
                                                <input id="outgoing.first_surname" name="outgoing.first_surname"
                                                    class="{{ $input }}" placeholder="VANEGAS" type="text"
                                                    x-model="$wire.outgoing.first_surname"
                                                    x-on:input="$wire.outgoing.first_surname = transformedInput($wire.outgoing.first_surname)"
                                                    wire:model="outgoing.first_surname" {{-- required  --}} />
                                            </div>

                                            {{-- todo second_surname --}}
                                            <div class="mb-3">
                                                <label class="{{ $label }}"
                                                    for="outgoing.second_surname">Segundo
                                                    Apellido:</label>
                                                <x-input-error for='outgoing.second_surname' />
                                                <input id="outgoing.second_surname" name="outgoing.second_surname"
                                                    class="{{ $input }}" placeholder="GARCÍA" type="text"
                                                    x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
                                                    x-bind:disabled="markedSecondSurname"
                                                    x-bind:required="markedSecondSurname"
                                                    x-model="$wire.outgoing.second_surname"
                                                    x-on:input="$wire.outgoing.second_surname = transformedInput($wire.outgoing.second_surname)"
                                                    wire:model="outgoing.second_surname" />
                                                <div>

                                                </div>
                                            </div>

                                            {{-- todo Phone --}}
                                            <div class="mb-3">
                                                <label class="{{ $label }}"
                                                    for="incoming.phone_number">Teléfono:</label>
                                                <x-input-error for='incoming.phone_code' />
                                                <x-input-error for='incoming.phone_number' />
                                                <div class="flex" style="margin-top: 10px;">
                                                    <select id="incoming.phone_code"
                                                        class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                        name="incoming.phoneCode" wire:model='incoming.phone_code'>
                                                        <option value="0412">0412</option>
                                                        <option value="0414">0414</option>
                                                        <option value="0412">0416</option>
                                                        <option value="0424">0424</option>
                                                        <option value="0426">0426</option>
                                                    </select>
                                                    <p class="font-extrabold block p-2">-</p>
                                                    <input id="incoming.phone_number"
                                                        class="'mb-5 mt 3 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';"
                                                        name="incoming.phone_number" type="tel"
                                                        x-model='incoming.phone_number'
                                                        x-on:input="$wire.incoming.phone_number = updateValue($wire.incoming.phone_number, 7)"
                                                        wire:model="incoming.phone_number" />
                                                </div>
                                            </div>


                                            {{-- todo Gmail --}}
                                            <div class="mb-3">
                                                <label class="{{ $label }}" for="outgoing.gmail">Correo UAI
                                                    gmail:</label>
                                                <x-input-error for='outgoing.gmail' />
                                                <input id="outgoing.gmail" name="outgoing.gmail"
                                                    class="{{ $input }}" type="email"
                                                    wire:model="outgoing.gmail" placeholder="jenblukvanegas@gmail.com"
                                                    x-model='$wire.outgoing.gmail'>
                                            </div>

                                            {{-- todo Email cantv --}}
                                            <div class="mb-3">
                                                <label class="{{ $label }}" for="outgoing.email_cantv">Correo
                                                    Institucional:</label>
                                                <x-input-error for='outgoing.email_cantv' />
                                                <input id="outgoing.email_cantv" name="outgoing.email_cantv"
                                                    class="{{ $input }}" placeholder="jvane01@cantv.com.ve"
                                                    type="email" wire:model="outgoing.email_cantv"
                                                    x-model='$wire.outgoing.email_cantv'>
                                            </div>
                                        </div>s







                                            {{-- Entrante --}}
                                            <div class="mb-3">
                                                <p style="margin-left: 550px; margin-top: -1200px;"
                                                    class="text-gray-600">
                                                    P00:
                                                </p>

                                                <div class="flex" style="margin-left: 550px;margin-top;">

                                                    <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                        style="margin-top: 15px;">
                                                        P00</div>

                                                    <p class="font-extrabold block p-2" style="margin-top: 15px;">-
                                                    </p>


                                                    <input
                                                        class="  'mb-5 mt-3 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';"
                                                        id="saliente-p00" name="saliente-p00"
                                                        style="margin-top: 15px" name="saliente-personal_id"
                                                        placeholder="155718" type="text"{{--  x-model="$wire.p00" --}}
                                                        {{--  x-on:input="$wire.p00 = updatep00($wire.p00)" wire:model="p00" --}} required>
                                                </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="mb-3">
                                                <label style="margin-left: 540px" class="{{ $label }}"
                                                    for="incoming.personal_id">Numero de Cedula:</label>
                                                <x-input-error for='incoming.personal_id' />
                                                <div class="flex" style=" margin-left: 540px">
                                                    <div class="flex h-10 items-center rounded-md border border-gray-300 p-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                        style="margin-top: 10px;">V</div>
                                                    <br>
                                                    <p style="margin-top: 5px;" class="font-extrabold block p-2">-</p>
                                                    <input id="incoming.personal_id" class="{{ $input }}"
                                                        name="incoming.personal_id" type="text"
                                                        x-model="$wire.incoming.personal_id"
                                                        x-on:input="$wire.incoming.personal_id = updateValue($wire.incoming.personal_id, 6)"
                                                        wire:model="incoming.personal_id">
                                                </div>
                                            </div>

                                            <div class="bg mb-3" style="margin-top: 25px;">
                                                <label style="margin-left: 550px"{{ $label }}
                                                    for="incoming.first_name">Primer Nombre:</label>
                                                <x-input-error for='incoming.first_name' />
                                                <input style="margin-left: 550px" id="incoming.first_name"
                                                    class="{{ $input }}" name="incoming.first_name"
                                                    type="text" placeholder="JENBLUK" required />

                                            </div>

                                            <div class="mb-3">
                                                <label style="margin-left: 550px" class="{{ $label }}"
                                                    for="incoming.second_name">Segundo Nombre:</label>
                                                <x-input-error for='incoming.second_name' />
                                                <input style="margin-left: 550px" id="incoming.second_name"
                                                    class="{{ $input }}" name="incoming.second_name"
                                                    type="text" x-model="$wire.incoming.second_name"
                                                    x-on:input="$wire.incoming.second_name = transformedInput($wire.incoming.second_name)"
                                                    x-bind:class="markedSecondName ? 'bg-gray-200' : ''"
                                                    x-bind:disabled="markedSecondName"
                                                    x-bind:required="markedSecondName"
                                                    wire:model="incoming.second_name" />

                                            </div>

                                            {{-- todo FirstSurname --}}
                                            <div class="mb-3">
                                                <label style="margin-left: 550px" class="{{ $label }}"
                                                    for="incoming.first_surname">Primer Apellido:</label>
                                                <x-input-error for='incoming.first_surname' />
                                                <input style="margin-left: 550px" id="incoming.first_surname"
                                                    class="{{ $input }}" placeholder="VANEGAS" type="text"
                                                    x-model="$wire.incoming.first_surname"
                                                    x-on:input="$wire.incoming.first_surname = transformedInput($wire.incoming.first_surname)"
                                                    wire:model="incoming.first_surname" />
                                            </div>

                                            {{-- todo secondSurname --}}
                                            <div class="mb-3">
                                                <label style="margin-left: 550px"class="{{ $label }}"
                                                    for="incoming.second_surname">Segundo Apellido:</label>
                                                <x-input-error for='incoming.second_surname' />
                                                <input style="margin-left: 550px" id="incoming.second_surname"
                                                    class="{{ $input }}" name="second_surname"
                                                    placeholder="GARCÍA" type="text"
                                                    x-bind:class="markedSecondSurname ? 'bg-gray-200' : ''"
                                                    x-bind:disabled="markedSecondSurname"
                                                    x-bind:required="markedSecondSurname"
                                                    x-model="$wire.incoming.second_surname"
                                                    x-on:input="$wire.incoming.second_surname = transformedInput($wire.incoming.second_surname)"
                                                    wire:model="incoming.second_surname" />

                                            </div>

                                            {{-- todo Phone --}}
                                            <div class="mb-3">
                                                <label style="margin-left: 550px" class="{{ $label }}"
                                                    for="incoming.phone_number">Teléfono:</label>
                                                <x-input-error for='incoming.phone_code' />
                                                <x-input-error for='incoming.phone_number' />
                                                <div class="flex">
                                                    <select style="margin-left: 550px" id="incoming.phone_code"
                                                        class="flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm"
                                                        name="incoming.phoneCode" wire:model='incoming.phone_code'>
                                                        <option value="0412">0412</option>
                                                        <option value="0414">0414</option>
                                                        <option value="0412">0416</option>
                                                        <option value="0424">0424</option>
                                                        <option value="0426">0426</option>
                                                    </select>
                                                    <p class="font-extrabold block p-2">-</p>
                                                    <input id="incoming.phone_number"
                                                        class="'mb-5 mt 3 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';"
                                                        name="incoming.phone_number" type="tel"
                                                        name="incoming.phone_number" type="tel"
                                                        x-model='incoming.phone_number'
                                                        x-on:input="$wire.incoming.phone_number = updateValue($wire.incoming.phone_number, 7)"
                                                        wire:model="incoming.phone_number" />
                                                </div>
                                            </div>

                                            {{-- todo Gmail --}}
                                            <div class="mb-3">
                                                <label style="margin-left: 550px" class="{{ $label }}"
                                                    for="incoming.gmail">Correo UAI gmail:</label>
                                                <x-input-error for='incoming.gmail' />
                                                <input style="margin-left: 550px" id="incoming.gmail"
                                                    class="{{ $input }}" name="incoming.gmail" type="email"
                                                    placeholder="jenblukvanegas@gmail.com"
                                                    x-model='$wire.incoming.gmail' wire:model="incoming.gmail">
                                            </div>

                                            {{-- todo Email cantv --}}
                                            <div class="mb-3">
                                                <label style="margin-left: 537px" class="{{ $label }}"
                                                    for="incoming.email_cantv">Correo Institucional:</label>
                                                <x-input-error for='incoming.email_cantv' />
                                                <input style="margin-left: 550px" id="incoming.email_cantv"
                                                    class="{{ $input }}" name="incoming.email_cantv"
                                                    type="email" placeholder="jvane01@cantv.com.ve"
                                                    x-model='$wire.incoming.email_cantv'
                                                    wire:model="incoming.email_cantv">
                                            </div>







                                            <x-button wire:submit>guardar</x-button>
                                    </form>
                                </div>
                        </section>

                    </div>
                </div>
            </div>


    </x-section-basic>
</div>
