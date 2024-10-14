<div>
    @assets @vite(['resources/js/hola.js']) @endassets
    
    @push('alert')
        <x-notification on="add-audit-activity-save-ok" />
        <x-notification on="add-audit-activity-cancel-ok" theme="warning" />
    @endpush

    <x-button x-on:click="$wire.open = true">{{\__("Nueva Actuacion Fiscal")}}</x-button>

    <form wire:submit="save" x-data>
    <x-dialog-modal wire:model="open" maxWidth="3xl" class="overflow-hidden">
        <x-slot:title>
            <div class="flex justify-between">

                <span class="text-2xl">
                    {{ \__("Actuacion Fiscal") }} 
                </span>
                
                <div class="flex flex-col mb-2 w-fit">
                    <x-input id="auditActivity.public_id" wire:model='auditActivity.public_id' type="number" 
                    placeholder="Codigo: {{App\Models\AuditActivity::all()->last()->public_id + 1}}" />
                    <x-input-error for="auditActivity.public_id" />
                    </div>
                </x-slot>

            </div>
        <x-slot:content>

            <div class="flex justify-between align-middle">
                
                <div>
                    <livewire:AuditActivity.SelectArea wire:model="auditActivity.area">
                    <x-input-error for="auditActivity.area" />
                </div>
                
                <div>
                    <livewire:Components.SelectSomething wire:model="auditActivity.type_audit" :items="App\Models\TypeAudit::select('name')->get()" id="auditActivity.type_audit" placeholder="Seleccione un tipo" title="Tipos de auditoria">
                    <x-input-error for="auditActivity.type_audit" />
                </div>

                <div>
                    <livewire:Components.SelectSomething wire:model="auditActivity.uai" :items="App\Models\Uai::select('name')->get()" id="auditActivity.uai" placeholder="Coordinaciones" title="Area de la UAI encargada">
                    <x-input-error for="auditActivity.uai" />
                </div>

            </div>

            <div class="w-full mb-2">
                <x-label for="auditActivity.description">{{ \__("Descripcion") }}</x-label>
                <x-input class="w-full" wire:model="auditActivity.description" placeholder="Ingrese aqui la descripcion de la Actuacion..." />
                <x-input-error for="auditActivity.description" />
            </div>

            <div>  
                <x-label for="auditActivity.objective">{{\__("Objetivo")}}</x-label>
                <textarea id="auditActivity.objective" wire:model="auditActivity.objective" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Escribe aqui el objetivo de la actucacion fiscal..." wire:model=""></textarea>
                <x-input-error for="auditActivity.objective" />
            </div>

            <div class="flex mt-3">
                <div class="w-1/2 mr-2">
                    <label for="month_start" class="mr-2 text-base font-semibold">{{\__("Mes inicio:")}}</label>
                    <div>
                        <livewire:Components.MonthPicker wire:model="auditActivity.month_start" alpine="month_start" id="auditActivity.month_start">
                        <x-input-error for="auditActivity.month_start" />

                    </div>
                </div>
                <div class="w-1/2">
                    <label for="month_end" class="mr-2 text-base font-semibold">{{\__("Mes Fin:")}}</label>
                    <div>
                        <livewire:Components.MonthPicker wire:model="auditActivity.month_end" alpine="month_end" id="auditActivity.month_end">
                        <x-input-error for="auditActivity.month_end" />
                    </div>
                </div>
            </div>

            @isset($handoverDocument)

            <ul class="flex font-semibold border-b cursor-pointer select-none hover:bg-gray-100 active:bg-gray-300">

                <li class="px-6 py-3" scope="row" x-text="{{$handoverDocument->id}}"></li>
                <li class="px-6 py-3" x-text="{{$handoverDocument->employee_outgoing->first_name . " " . $handoverDocument->employee_outgoing->first_surname}}"></li>
                <li class="px-6 py-3" x-text="{{$handoverDocument->departament}}"></li>

            </ul>
            @endisset
            
        </x-slot>
        <x-slot:footer>
            <div x-show="$wire.auditActivity.type_audit === '{{App\Models\typeAudit::find(1)->name}}'" class="mr-3" >
                <x-secondary-button x-on:click="$wire.dispatch('open_browser_handover')">{{\__("Anexar datos del acta de entrega")}}</x-secondary-button>
            </div>
            <x-button class="mr-3" type="submit">Guardar</x-button>
            <x-secondary-button type="button" wire:click='cancel'>Cancelar</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    </form>

    @push('modals') <livewire:Component.HandoverBrowser> @endpush

    <p x-on:add_handoverDocument.window="alert('hola')">hola</p>
   
</div>
