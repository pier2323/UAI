@props(['tabs' => ['about']])

<div x-data="{

@foreach($tabs as $tab)
{{ $tab }}: false,
@endforeach

active() {
@foreach($tabs as $tab)
this.{{ $tab }} = false;
@endforeach
return true
}

}" 

class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

    {{-- headerNav --}}
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="cardTabs" role="tablist">

        @foreach ($tabs as $tab)
            <x-card-tab :title="$tab"></x-card-tab>
        @endforeach
      
    </ul>

    {{-- Content --}}
    <div id="defaultTabContent">

        @foreach ($tabs as $item) 
        <div x-show="{{$item}}">
            {{ $$item }} 
        </div>
        @endforeach

    </div>

    {{-- <script>
        function cardHandover(){
            return {
                @foreach ( as )
                    
                @endforeach
            }
        }
    </script> --}}
</div>





