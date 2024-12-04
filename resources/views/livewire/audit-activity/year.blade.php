<div class="m-4">

    {{-- Stop trying to control. --}}

    <x-secondary-button type="button" x-on:click="$wire.is_open = true">{{ $year->active }}</x-secondary-button>

    <form>
        <x-dialog-modal wire:model="is_open" maxWidth="2xl">
            <x-slot name="title">Configuracion del Año Fiscal</x-slot>
            <x-slot name="content">

            @php
                $years = \App\Models\AuditActivity::distinct()->orderBy('year', 'asc')->pluck('year');
            @endphp

            <div class="flex items-center justify-center py-4 my-2 overflow-scroll flex-nowrap">

                @foreach ($years as $index => $yearValue)
                    <div class="flex items-center">
                        @if ($index !== 0)
                            <div role="line" class="bg-purple-600 h-0.5 w-8"></div>
                        @endif
                        <x-year-radio model="year.forSelection" value="{{ $yearValue }}" />
                    </div>
                @endforeach

                {{-- <div class="flex items-center">
                    <div role="line" class="bg-purple-600 h-0.5 w-8"></div>

                    @php
                        $newYear = $years->count() + 1;
                        $id = 'year-radio-' . $newYear;
                    @endphp
                    <div
                        class="flex items-center justify-center w-20 h-20 p-3 border-2 border-purple-600 rounded-full"
                        :class="$wire.active == {{$newYear}} ? 'bg-blue-600': 'bg-gray-600'"
                        x-on:click="$wire.active = {{$newYear}}"
                    >
                        <input x-show="false" id='{{$id}}' type="radio" wire:model='year.active' value="{{$newYear}}">
                        <label class="text-2xl font-extrabold text-white" for="{{$id}}">+</label>
                    </div>
                </div> --}}

            </div>


            </x-slot>
            <x-slot name="footer">
                <x-button
                    type="button"
                    x-on:click="$wire.changeSelected().then(() => {$wire.$parent.refresh()})"
                    class="mr-3"
                    x-show="$wire.year.selected != $wire.year.forSelection"
                >
                    Ver
                </x-button>

                @if ($year->selected == $year->active)
                    <x-button class="bg-red-400 focus:bg-red-500 hover:bg-red-300 active:bg-red-600"
                        type="button"
                        wire:confirm
                        x-on:click="$wire.closeYear().then(() => {$wire.$parent.refresh()})"
                    >
                        Cerrar Año fiscal
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
