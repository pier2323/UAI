{{-- todo classes css --}}
@php
    $label = 'col-form-label';
    $input = 'flex h-10 w-full items-center rounded-md border border-gray-300 border-red-400 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
    $title = 'Registro de Acta de Entrega';
    $phone = "flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm";
@endphp  

<div>
   
    <style>
      .section {
        height: 0px;
      }

      .active {
        height: auto!important;
        transition: 1s
      }
    </style>
    
    <x-button wire:click="$set('open', true)">Nueva Acta de Entrega</x-button>
    
    <form wire:submit='save' method="POST">
        <x-dialog-modal id="form" maxWidth="2xl" wire:model="open">
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="content">
            <div x-data="
            {
                handover: true, 
                incoming: false, 
                outgoing: false, 
                toggleTab(tab){
                    this.handover = false;
                    this.incoming = false;
                    this.outgoing = false;
                    return true
                }
            }"
            >
                <div class="flex gap-5">
                    <x-button type='button' class='flex justify-center w-24' x-bind:class="handover ? 'bg-blue-400 focus:bg-blue-400' : ''" 
                    x-on:click="handover = toggleTab(handover)">Acta</x-button>

                    <x-button type='button' class='flex justify-center w-24' x-bind:class="outgoing ? 'bg-blue-400 focus:bg-blue-400' : ''" 
                    x-on:click="outgoing = toggleTab(outgoing)">Saliente</x-button>

                    <x-button type='button' class='flex justify-center w-24' x-bind:class="incoming ? 'bg-blue-400 focus:bg-blue-400' : ''" 
                    x-on:click="incoming = toggleTab(incoming)">Entrante</x-button>

                </div>

                <div class="flex">
                    <div x-bind:class="handover ? 'active w-full' : 'hidden'" >
                        @include('livewire.audit-activity.register-form.handoverDocument-form')
                    </div>
                    <div x-bind:class="outgoing ? 'active w-full' : 'hidden'" >
                        @include('livewire.audit-activity.register-form.outgoing-form')
                    </div>
                    <div x-bind:class="incoming ? 'active w-full' : 'hidden'" >
                        @include('livewire.audit-activity.register-form.incoming-form')
                    </div>
                </div>
                </div>
            </x-slot>
            
            <x-slot name="footer">
              <x-secondary-button class="ml-2" wire:click="$set('open', false)">Cerrar</x-secondary-button>
                <x-secondary-button class="ml-2" wire:click="restartProperties">Cancelar</x-secondary-button>
                <x-button class="ml-2" type='submit'>Guardar</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>

@push('alert')
        
<x-notification on="saved"/>
<x-notification on="error" theme="error"/>

@endpush