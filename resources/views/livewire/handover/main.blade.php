<div>

    @php
        $th = "colspan='1' rowspan=-'1' tabindex='0'";
        $td = 'px-4 py-2';
        $headerTitle = ['Código ', 'Objetivo', 'Mes inicio', 'Mes fin', 'Area UAI Encargada',]
    @endphp

    {{-- @dd(json_encode($designations)) --}}

    <x-section-basic>

        <x-input class="ml-6" type="search" wire:model.live="query" placeholder='Buscar...' />

        <table>  

            {{-- todo head --}}
            <thead> 
                @foreach ($headerTitle as $row)
                    <th class="px-4 py-2 border-b border-b-slate-300" {{$th}}> {{ $row }} </th>
                @endforeach
            </thead>

            {{-- todo body --}}
            <tbody>
                @foreach ($designations as $designation)

                <tr 
                class="cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300" 
                wire:key="{{ $designation->auditActivity->id }}" 
                wire:dblclick="goTo('handover.show', {{ $designation->id }})"
                wire:loading.attr="disabled"
                >
                    <td class=" min-w-fit w-36 text-slate-600 {{ $td }}">{{ $designation->auditActivity->code }}</td> 
                    <td class=" {{ $td }}">{{ $designation->auditActivity->description }}</td> 
                    <td class=" {{ $td }}">{{ $designation->auditActivity->month_start }}</td> 
                    <td class=" {{ $td }}">{{ $designation->auditActivity->month_end }}</td>
                    <td class=" {{ $td }}">{{ $designation->auditActivity->uai->name ?? '' }}</td>

                </tr>

                @endforeach
            </tbody>
            
        </table>
        {{ $designations->links() }}

    </x-section-basic>

</div>

