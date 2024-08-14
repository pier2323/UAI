@php
    function divideWords($text, $numbersOfWords, $divideBy = " "): array {
        $words = explode($divideBy, $text);
        $firstWords = array_slice($words, 0, $numbersOfWords);
        $firstWord = implode($divideBy, $firstWords);
        $restOfWords = implode($divideBy, array_slice($words, $numbersOfWords));
        return [$firstWord, $restOfWords];
    }
@endphp

@push('styles') 
<style>
        #heading-description-firstword {
                background: linear-gradient(90deg, #094d79, #9d00f7);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
        }

        #heading-objective-firstword {
          
        }
</style>
@endpush

<div class="mt-10  mx-24">

        {{-- todo title one --}}
        <div class="flex justify-between">

                @php [$firstWord, $restOfWords] = divideWords($auditActivity->description, 1); @endphp

                {{-- ? description --}}
                <h1 class="w-3/6 text-4xl font-semibold text-justify" role="description">
                        <b class=" h-fit text-4xl font-bold border-b-2 border-black w-fit" id='heading-description-firstword'>{{ $firstWord }}</b>
                        <span>{{ $restOfWords }}</span>
                </h1>

                {{-- ? code --}}
                <span class=" text-xl text-slate-400" role="code">{{ $auditActivity->code }}</span>
        </div>

        {{-- todo Objective --}}
        <div class="mt-10">
                @php [$firstWord, $restOfWords] = divideWords($auditActivity->objective, 1, '"'); @endphp
          
                {{-- ? objetive --}}
                <h3 class="font-semibold" role="objective">
                        @php $firstWord = rtrim($firstWord) @endphp

                        <b class="block h-fit text-5xl font-bold w-full" id='heading-objective-firstword'>{{ $firstWord }}.</b>
                        <p class=" p-6 pt-10 border-t-2 border-black mt-3 text-2xl bg-amber-50 text-justify">"{{ $restOfWords }}</p>
                </h3>
        </div>
</div>