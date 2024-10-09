 <div>
    
    <form wire:submit='save'>
        <x-section-basic>
            <div class="mb-3">
                <h3 class="text-3xl font-semibold">{{ \__("Acta de Entrega") }}</h3>
                <hr class="mt-2">
            </div>
            <div class="flex items-start justify-evenly">
                <div>
                    @include('livewire.audit-activity.show.register-form.handoverDocument-form')
                </div>
                <div id="handoverPersonal">
                
                    <x-card-handover :tabs="['Saliente' => 'outgoing', 'Entrante' => 'incoming']" default="outgoing">
                        <x-slot name="outgoing">
                            @include('livewire.audit-activity.show.register-form.outgoing-form')
                        </x-slot>
                        

                        <x-slot name="incoming" >
                            @include('livewire.audit-activity.show.register-form.incoming-form')
                        </x-slot>
                    </x-card-handover>

                </div>
            </div>
            <x-slot:footer>
                <x-button class="ml-4" type="submit">{{ \__("Guardar") }}</x-button>
            </x-slot>
        </x-section-basic>
    </form>

</div>
