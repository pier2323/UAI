 <div>
    @push('script') @assets  @vite(['resources/js/hola.js']) @endassets @endpush
    @php
        $th = "colspan='1' rowspan=-'1' tabindex='0'";
        $td = 'px-4 py-2';
        $headerTitle = ['Código ', 'Objetivo', 'Mes inicio', 'Mes fin', 'Area UAI Encargada',]
    @endphp

    <x-section-basic>
        <div class="m-6"> <livewire:auditActivity.registerForm.main> </div>

        {{-- todo browser --}}
        
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
                @foreach ($auditActivities as $auditActivity)

                <tr 
                class="cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300" 
                wire:key="{{ $auditActivity->id }}" 
                wire:dblclick="goTo('auditActivity.show', {{ $auditActivity->id }})"
                wire:loading.attr="disabled"
                >
                    <td class=" min-w-fit w-36 text-slate-600 {{ $td }}">{{ $auditActivity->code }}</td> 
                    <td class=" {{ $td }}">{{ $auditActivity->description }}</td> 
                    <td class=" {{ $td }}">{{ $auditActivity->month_start }}</td> 
                    <td class=" {{ $td }}">{{ $auditActivity->month_end }}</td>
                    <td class=" {{ $td }}">{{ $auditActivity->uai->name ?? '' }}</td>

                </tr>

                @endforeach
            </tbody>
            
        </table>
        {{ $auditActivities->links() }}

    </x-section-basic>
</div>
