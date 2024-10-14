 <div @isset($auditActivity) x-on:saved.window="await $wire.$parent.load()" @endisset>
    
    <form wire:submit='save'>
        <x-section-basic>
            <div class="mb-3">
                <div class="flex ">
                    <h3 class="text-3xl font-semibold">{{ \__("Acta de Entrega") }}</h3>
                    <h3 class="mx-2 text-3xl font-semibold"> {{ \__("-") }} </h3>
                    @empty($modelsHandoverDocument) <h3 class="text-3xl font-semibold">{{ \__("Registro") }}</h3> @endempty
                    @isset($modelsHandoverDocument) <h3 class="text-3xl font-semibold">{{ \__("Información") }}</h3> @endisset
                </div>
                <hr class="mt-2">
            </div>
            <div class="flex items-start justify-evenly">
                <div class="w-96">
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
            @empty($modelsHandoverDocument)
            <x-slot:footer>
                <x-button class="ml-4" type="submit">{{ \__("Guardar") }}</x-button>
            </x-slot>
            @endempty
        </x-section-basic>
    </form>

</div>
