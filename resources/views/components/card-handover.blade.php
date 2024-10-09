@props(['tabs' => [], 'default' => ''])

<div x-data="{

@foreach($tabs as $tab)
@if($tab === $default) {{ $tab }}: true,
@else {{ $tab }}: false, @endif
@endforeach

active() {
@foreach($tabs as $tab)
this.{{ $tab }} = false;
@endforeach
return true
}

}" 

class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="width:40vw">

    {{-- todo headerNav --}}
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50" id="cardTabs" role="tablist">

        @foreach ($tabs as $title => $tab)
            <x-card-tab :$tab :$title />
        @endforeach
      
    </ul>

    {{-- todo Content --}}
    <div id="defaultTabContent" class="">

        @foreach ($tabs as $tab) 
        <div x-show="{{$tab}}" class="flex justify-center">
            {{ $$tab }} 
        </div>
        @endforeach

    </div>
</div>





