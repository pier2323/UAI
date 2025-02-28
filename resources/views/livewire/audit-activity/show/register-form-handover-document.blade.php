 <div x-data="registerFormHandoverDocument" @isset($auditActivity) x-on:saved.window="await $wire.$parent.load()" @endisset>

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
                <div class="flex">
                    <h3 class="text-3xl font-semibold">{{ \__("Acta de Entrega") }}</h3>
                    <h3 class="mx-2 text-3xl font-semibold"> {{ \__("-") }} </h3>
                    @if(empty($modelsHandoverDocument) and auth()->user()->can('handoverDocument.register'))
                        <h3 class="text-3xl font-semibold">{{ \__("Registro") }}</h3> 

                    @else
                        <h3 class="text-3xl font-semibold">{{ \__("Información") }}</h3>

                    @endif
                    @if(isset($modelsHandoverDocument) and auth()->user()->can('handoverDocument.register'))
                        <section role="buttons" class="inset-0 flex ml-auto">
                            <figure x-show="isEditing" x-on:click="$wire.cancel(); cancel()" x-ref="figureCancel" style="width: 6.5rem; display: none"
                                class="flex items-center justify-between p-2 mr-2 transition-all bg-red-100 rounded-full hover:bg-red-200 active:bg-red-300" 
                            >
                                <p class="pl-2 font-semibold" x-ref="buttonCancel">Cancelar</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#434343"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </figure>      
                
                            <figure x-show="!isEditing" x-on:click="$wire.isDeleting = true" x-ref="figureDelete" style="width: 6.5rem;"
                                class="flex items-center justify-between p-2 mr-2 transition-all bg-red-100 rounded-full hover:bg-red-200 active:bg-red-300" 
                            >
                                <p class="pl-2 font-semibold " x-ref="buttonDelete">Eliminar</p>
                                <svg style="width: 24px!important" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                            </figure> 
                            
                            <figure x-show="!isEditing" x-on:click="edit()" x-ref="figureEdit" style="width: 6.5rem;"
                                class="flex items-center justify-between p-2 transition-all bg-yellow-100 rounded-full hover:bg-yellow-200 active:bg-yellow-300"
                            >
                                <p class="pl-2 font-semibold" x-ref="buttonEdit">Editar</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-6v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662L13.25 15zM21.025 4.4l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                            </figure>     
                        </section>
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

<x-livewire>
    <script>
        Alpine.data('registerFormHandoverDocument', () => ({
            isEditing: false,
            edit() {
                this.isEditing = true;
            },
            cancel() {
                this.isEditing = false;
            },
            toggle(editing, el) {
                if(editing) {
                    el.removeAttribute('readonly');
                }
            }
        }))
    </script>
</x-livewire>
