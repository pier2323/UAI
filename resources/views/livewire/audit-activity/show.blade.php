<div>
    {{-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif --}}

    {{-- todo headings --}}
    <div role="headings">   <livewire:Components.AuditActivityHeadings audit='{{$auditActivity->id}}' objective></div>

    {{-- todo planning form --}}
    <form wire:submit='save'>
        @include('livewire.audit-activity.show.audit-commission')

        <livewire:Components.PlanningSchedule auditActivity="{{ $auditActivity->id }}">

        <x-button wire:submit x-on:click="$dispatch('saving')">send</x-button>
    </form>

    <x-button wire:click='getDesignationDocument'>descargar designacion</x-button>

</div>
