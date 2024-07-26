<div>
    {{-- todo classes css --}}
    @php
        $label = 'col-form-label';
        $input = 'flex h-10 w-full items-center rounded-md border border-gray-300 border-red-400 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm';
        $title = 'Registro de Acta de Entrega';
        $phone = "flex h-10 items-center rounded-md border border-gray-300 pl-3 text-sm font-normal text-gray-600 focus:border focus:border-indigo-500 focus:outline-none shadow-sm";
    @endphp



    <style>
      .section {
        height: 0px;
      }

      .active {
        height: auto!important;
        transition: 1s
      }
    </style>
    
    <x-button wire:click="$set('open', true)">Nueva Actuacion Fiscal</x-button>
    <form wire:submit='save' method="POST">
        <x-dialog-modal id="form" maxWidth="md" wire:model="open">
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="content">
              @include('livewire.audit-activity.register-form.handoverDocument-form')
              @include('livewire.audit-activity.register-form.outgoing-form')
              @include('livewire.audit-activity.register-form.incoming-form')
            </x-slot>
            
            <x-slot name="footer">
              <x-secondary-button class="ml-2" wire:click="$set('open', false)">Cerrar</x-secondary-button>
                <x-secondary-button class="ml-2" wire:click="restartProperties">Cancelar</x-secondary-button>
                <x-button class="ml-2" type='submit'>Guardar</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>