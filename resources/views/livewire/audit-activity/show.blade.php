<div>
    {{-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif --}}
    @push('script') @vite(['resources/js/hola.js']) @endpush

    {{-- todo headings --}}
    <div role="headings"> @include('livewire.audit-activity.show.headings') </div>

    {{-- todo planning form --}}
    <form wire:submit='save'>
        @include('livewire.audit-activity.show.audit-commission')
        @include('livewire.audit-activity.show.schedule') 

        <x-button wire:submit x-on:click="$dispatch('saving')">send</x-button>
    </form>

    <x-button wire:click='getDesignationDocument'>descargar designacion</x-button>

</div>
