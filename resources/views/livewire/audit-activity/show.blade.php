<div>
    {{-- @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif --}}
    <span role="headings" class="px-20 block">
        <h2 class="text-2xl font-bold mt-3 ml-4">{{ $auditActivity->objective }}</h2>
    </span>
    <form wire:submit='save'
    {{-- action="{{ route('designation.download') }}"  --}}
    {{-- method="POST"  --}}
    >
        {{-- @include('livewire.audit-activity.show.audit-commission') --}}
        @include('livewire.audit-activity.show.schedule')

        <x-button>send</x-button>
    </form>

    
</div>
