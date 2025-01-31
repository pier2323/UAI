 <div @isset($auditActivity) x-on:saved.window="await $wire.$parent.load()" @endisset>

    @can('handoverDocument.register')
        @push('alert')
            <x-alert on="saved" />
        @endpush
    @endcan
    
    <form 
        @can('handoverDocument.register')
            wire:submit='save'
        @endcan
    >
        <x-section-basic>
            <div class="mb-3">
                <div class="flex ">
                    <h3 class="text-3xl font-semibold">{{ \__("Acta de Entrega") }}</h3>
                    <h3 class="mx-2 text-3xl font-semibold"> {{ \__("-") }} </h3>
                    @if(empty($modelsHandoverDocument) and auth()->user()->can('handoverDocument.register'))
                        <h3 class="text-3xl font-semibold">{{ \__("Registro") }}</h3> 

                    @else
                        <h3 class="text-3xl font-semibold">{{ \__("Información") }}</h3>

                    @endif
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
                @can('handoverDocument.register')
                    <x-button class="ml-4" type="submit">{{ \__("Guardar") }}</x-button>
                @endcan
            </x-slot>
            @endempty
        </x-section-basic>
    </form>

</div>
