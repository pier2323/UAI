 <div>

    @php
    $label = 'col-form-label';
    $input = '';
    $title = 'Registro de Acta de Entrega';
    $phone = "flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm";
    @endphp
    
    <form wire:submit='save'>
        <x-section-basic>
            <div class="mb-3">
                <h3 class="text-3xl font-semibold">{{ \__("Acta de Entrega") }}</h3>
                <hr class="mt-2">
            </div>
            <div class="flex items-center justify-evenly">
                @include('livewire.audit-activity.show.register-form.handoverDocument-form')
                <div id="handoverPersonal" class="flex flex-col overflow-scroll border-2 border-black rounded-lg" style="height: 80vh; scroll: thin;">
                
                    <div class="mb-3">
                        @include('livewire.audit-activity.show.register-form.outgoing-form')
                    </div>
                    
                    <hr class="self-center w-11/12 bg-black rounded-lg min-h-0.5 "/>

                    <div>
                        @include('livewire.audit-activity.show.register-form.incoming-form')
                    </div>
                    
                </div>
            </div>
            <x-slot:footer>
                <x-button class="ml-4" type="submit">{{ \__("Guardar") }}</x-button>
            </x-slot>
        </x-section-basic>
    </form>

</div>
