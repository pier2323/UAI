<div>
    @php
        $th = "colspan='1' rowspan=-'1' tabindex='0'";
    @endphp
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800"> {{ __('Dashboard') }} </h2>
    </x-slot>
    <x-section-basic>
        <div class="m-6">
            @livewire('auditActivity.registerForm.main')
        </div>
        <x-table>
            <x-slot name="head">
                <thead> 
                    <tr>
                        <th 
                            aria-controls="datatable_users"
                            aria-label="#: activate to sort column ascending" 
                            class="code centered sorting sorting_desc px-4 py-2" 
                            aria-sort="descending"
                            {{$th}}
                        >
                            Código
                        </th>
                        <th aria-controls="datatable_users"
                            aria-label="Name: activate to sort column ascending"
                            class="centered sorting px-4 py-2" 
                            {{-- style="width: 189px"  --}}
                            {{$th}}
                            
                        >
                            Objetivo
                        </th>
                        <th aria-controls="datatable_users"
                            aria-label="Company: activate to sort column ascending"
                            class="centered sorting px-4 py-2" 
                            {{$th}}

                        >
                            Fecha inicio
                        </th>
                        <th 
                            aria-label="Status" 
                            class="centered sorting_disabled px-4 py-2" 
                            {{$th}}
    
                        >
                            Fecha fin
                        </th>
                        <th 
                            aria-label="Status" 
                            class="centered sorting_disabled px-4 py-2" 
                            {{$th}}
                        > Area UAI Encargada
                        </th>
                        {{-- <th 
                            aria-label="Status" 
                            class="centered sorting_disabled px-4 py-2" 
                            style="width: 60px"
                            {{$th}} 
                        > status
                        </th> --}}
                    </tr>
                </thead>
            </x-slot>
            @foreach ($auditActivities as $auditActivity)

                @php
                    $id = $auditActivity->id;
                @endphp



                <tr   
                class="hover:bg-gray-100 cursor-pointer"
                wire:key="{{ $auditActivity->id }}"
                x-on:dblclick="$wire.goTo(
                'auditActivity.show', 
                {{ $id }})"
                >
                    {{-- todo Codigo --}}
                    <td class="px-4 py-2">{{ $auditActivity->id }}</td> 
                    
                    {{-- todo Objetivo --}}
                    <td class="px-4 py-2">{{ $auditActivity->handoverDocument->target }}</td> 
                    
                    {{-- todo Fecha inicio --}}
                    <td class="px-4 py-2">{{ $auditActivity->planning_start }}</td> 
                    
                    {{-- todo Fecha fin --}}
                    <td class="px-4 py-2">{{ $auditActivity->planning_end }}</td>
                    
                    {{-- todo Area UAI --}}
                    @php
                        $employee = $auditActivity->employee->count() == 1 ? $auditActivity->employee: '';
                    @endphp
                    <td class="px-4 py-2">{{ $employee->uai->name ?? '' }}</td> 

                    <td style='display:none'></td>

                    {{-- todo status --}}
                    {{-- <td class="px-4 py-2">{{ $employee->uai->name ?? '' }}</td>  --}}
                </tr>
            @endforeach
        </x-table>
    </x-section-basic>
</div>
