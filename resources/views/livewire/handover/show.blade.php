<div>
    {{-- @dump($auditActivity->id) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 = focus:outline-none shadow-sm';
    @endphp
    <x-section-basic>

        <livewire:Components.AuditActivityHeadings :audit="$auditActivity->id">
            <br>
            <br>
            <br>
            <x-Card>
                <x-slot:titulo>
                    Detalles del Acta
                </x-slot>
                <x-slot:des>
                    <li> Codigo de la Actuación:<br>
                        {{ $auditActivity->code }}</li>
                    <li> Descripcion :
                        <br>
                        {{ $auditActivity->description }}
                    </li>
                    <li> Mes inicio: &nbsp; &nbsp;

                        <br>{{ $auditActivity->month_start }}
                    </li>
                    <li>
                        Mes fin:
                        <br>
                        {{ $auditActivity->month_end }}
                    </li>
                    <li>
                        Area Encargada:
                        <br>
                        {{ $auditActivity->uai->name }}


                    </li>
                    <li>
                        Personal designado:
                        <br>
                        {{ $auditActivity->comision }}
                    </li>

                </x-slot>
            </x-Card>
            <br>
            <div style="margin-left: 400px; margin-top: -570px;">

                <x-Card>
                    <x-slot:titulo>
                        Detalles del entrante
                    </x-slot>
                    <x-slot:des>
                        <li> Nombre: <br></li>
                        <li> Cedula: <br> </li>
                        <li> P00: <br></li>
                        <li> Cargo: <br></li>
                        <li>telefono: <br></li>
                        <li>Coreo eletronico: <br></li>
                    </x-slot>
                </x-Card>

            </div>
            <div style="margin-left: 800px; margin-top: -405px;">
                <x-Card>
                    <x-slot:titulo>
                        Detalles del Saliente
                    </x-slot>
                    <x-slot:des>
                        <li> Nombre: <br></li>
                        <li> Cedula: <br></li>
                        <li> P00: <br></li>
                        <li> Cargo: <br></li>
                        <li>telefono: <br></li>
                        <li>Coreo eletronico: <br></li>
                    </x-slot>
                </x-Card>
            </div>

            <x-button style="margin-top: 200px" wire:click='requeriDocumen'> Requerimiento</x-button>
            <x-button wire:click='programaDocumen'> Programa de trabajo</x-button>
            <x-button style="margin-left:340px" wire:click='CedulaDocumen'>Cedula de trabajo </x-button>
            <x-button wire:click='InformeDocumen'>Informe del Auditor </x-button>



            {{--  PRUEVAsubir archivo y visulizarlo  --}}


{{-- composer require "ext-gd:*" --ignore-platform-reqs --}}
           











    </x-section-basic>
</div>
