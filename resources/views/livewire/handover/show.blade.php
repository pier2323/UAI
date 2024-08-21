<div>
    {{-- @dump($auditActivity->id) --}}
    @php
        $label = 'col-form-label';
        $input =
            'mb-5 mt-2 flex h-10  items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
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
                    <li> Mes inicio &nbsp; &nbsp;

                    </li>
                    <li>
                        Mes fin
                        <br>{{ $auditActivity->month_start }}

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
            <div style="margin-left: 400px; margin-top: -500px;">

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
            <div style="margin-left: 800px; margin-top: -360px;">
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

            <x-button style="margin-top: 400px" wire:click='requeriDocumen'> Requrimiento </x-button>
            <x-button> Programa de trabajo </x-button>
            {{--  <div class="border- mr-4 w-full text-left  sm:w-1/2 sm:text-left">
                                <ul class="mb-8 flex flex-col items-left space-y-1 dark:text-slate-400 sm:items-start">
                                    <div class="card">
                                        <h1 class="card-title"> Datos Acta fiscal</h1>
                                        </li>
                                    </div> 
                                
                                <style>
                                    .body {
                                        margin: 0;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        height: 100vh;
                                    }

                                    .card {
                                        background: linear-gradient(to right, #AA00F7, #00abff);
                                        color: rgb(255, 255, 255);
                                        margin-left: -250px;
                                        margin-bottom: 60px;
                                        text-align: center;
                                        width: 214%;
                                        border-radius: 10px;
                                        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
                                    }

                                    .card-title {
                                        font-size: 2rem;
                                    }

                                    .card:hover {
                                        background: linear-gradient(to left, #AA00F7, #00abff);
                                    }

                                    .container {
                                        max-width: 800px;
                                        margin: 0 auto;
                                        padding: 20px;
                                    }

                                    .acta-table {
                                        border-collapse: collapse;
                                        width: 100%;
                                    }

                                    .acta-table th,
                                    .acta-table td {
                                        border: 1px solid #ddd;
                                        padding: 8px;
                                        text-align: left;
                                    }

                                    .acta-table th {
                                        background-color: #f2f2f2;
                                    }

                                    .persona {
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }
                                </style> --}}


    </x-section-basic>
</div>
