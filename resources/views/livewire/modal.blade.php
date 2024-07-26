<div>
    <x-button wire:click="$set('open', true)">post</x-button>
    <x-dialog-modal id="{{ $modal }}" wire:model='open'>
        <x-slot name='title'>post</x-slot>
        <x-slot name='content'>
            <form class="flex flex-col p-5">
                <div class="mb-3">
                    <label>titulo</label>
                    <x-input type="text"/>
                </div>
                <textarea name="content" cols="30" rows="10"></textarea>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open', false)">cancelar</x-button>
            <x-button>guardar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
