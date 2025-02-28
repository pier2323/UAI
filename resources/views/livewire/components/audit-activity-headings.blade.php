<?php

use App\Models\AuditActivity;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;

new class extends \Livewire\Volt\Component
{
    #[Reactive]
    public AuditActivity $auditActivity;

    #[Locked]
    public $objective;

    public function mount(Bool $objective = false)
    {
        $this->objective = $objective;
    }
};

?>

<div>
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

    <div class="mx-24 mt-10">

        {{-- todo title one --}}
        <div class="flex justify-between">

                @php [$firstWord, $restOfWords] = divideWords($auditActivity->description, 1); @endphp

                {{-- ? description --}}
                <h1 class="w-3/6 text-4xl font-semibold text-justify" role="description">
                        <b class="text-4xl font-bold border-b-2 border-black h-fit w-fit" id='heading-description-firstword'>{{ $firstWord }}</b>
                        <span>{{ $restOfWords }}</span>
                </h1>

                {{-- ? code --}}
                <span class="text-xl text-slate-400" role="code">{{ $auditActivity->code }}</span>
        </div>

        @if ($objective)
        
            {{-- todo Objective --}}
            <div class="mt-10">
                    @php [$firstWord, $restOfWords] = divideWords($auditActivity->objective, 1, '“'); @endphp
            
                    {{-- ? objetive --}}
                    <h3 class="font-semibold" role="objective">
                            @php $firstWord = rtrim($firstWord) @endphp

                            <b class="block w-full text-5xl font-bold h-fit" id='heading-objective-firstword'>{{ $firstWord }}.</b>
                            <p class="p-6 pt-10 mt-3 text-2xl text-justify border-t-2 border-black bg-amber-50">“{{ $restOfWords }}</p>
                    </h3>
            </div>
        
        @endif

    </div>
</div>