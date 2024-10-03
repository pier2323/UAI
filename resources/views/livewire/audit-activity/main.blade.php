 <div>
    @push('script') @assets  @vite(['resources/js/hola.js']) @endassets @endpush

    <x-section-basic>
        <div class="m-4">
            <livewire:AuditActivity.Add>
        </div>

        <div class="flex justify-between pr-10">
            {{-- todo browser --}}
            <x-input class="ml-6" type="search" wire:model.live="query" placeholder='Buscar...' />
            <h3 role="table-title" class="text-2xl font-semibold">Plan Operativo Anual</h3>
        </div>

        <style>
            .table-grid-audit {
                display: grid;
                grid-template-columns: 1fr 5fr repeat(3, 1fr);
                grid-column-gap: 1vw;
                grid-row-gap: 4vh;
            }
        </style>
        <ul class="justify-center mt-4 table-grid-audit">

            {{-- todo head --}}
            @foreach (['Código ', 'Descripcion', 'Mes inicio', 'Mes fin', 'Area UAI Encargada',] as $row)
                <li class="text-center border-b border-b-slate-300"> {{ $row }} </li>
            @endforeach

            {{-- todo body --}}
            @foreach ($auditActivities as $auditActivity)
            <form style="grid-column: span 5" class="cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300"  wire:key="{{ $auditActivity->id }}" wire:submit="goTo({{ $auditActivity->id }})" 
            >
                <button class="items-center table-grid-audit" wire:loading.attr="disabled">
                    <li>{{ $auditActivity->code }}</li> 
                    <li class="text-start">{{ $auditActivity->description }}</li> 
                    <li>{{ $auditActivity->month_start }}</li> 
                    <li>{{ $auditActivity->month_end }}</li>
                    <li>{{ $auditActivity->uai->name ?? '' }}</li>
                </button>
            </form>
            @endforeach
            
        </ul>
        {{ $auditActivities->links() }}
    </x-section-basic>


    
</div>
