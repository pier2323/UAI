<?php

use Livewire\Attributes\Locked;

new class extends \Livewire\Volt\Component
{
    #[Locked]
    public $repository;

    #[Locked]
    public bool $hasObjective = false;

    public object $object;

    public function mount(): void
    {
        $this->object = (object) $this->repository->object;
    }
};

function divideWords($text, $numbersOfWords, $divideBy = " "): array {
    $words = explode($divideBy, $text);
    $firstWords = array_slice($words, 0, $numbersOfWords);
    $firstWord = implode($divideBy, $firstWords);
    $restOfWords = implode($divideBy, array_slice($words, $numbersOfWords));
    return [$firstWord, $restOfWords];
}

?>

<div>

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

            @php 
                $description = $object->description;
                // dd($description);
                [$firstWord, $restOfWords] = divideWords($description, 1); 
            @endphp

            {{-- ? description --}}
            <h1 class="w-3/6 text-4xl font-semibold text-justify" role="description">
                    <b class="text-4xl font-bold border-b-2 border-black h-fit w-fit" id='heading-description-firstword'>{{ $firstWord }}</b>
                    <span>{{ $restOfWords }}</span>
            </h1>

            {{-- ? code --}}
            <span class="text-xl text-slate-400" role="code">{{ $object->code }}</span>
        </div>

        @php
            $objective = $object->objective;
            // dd($objective);
            if($objective) [$firstWord, $restOfWords] = divideWords($objective, 1, '“');
        @endphp

        @if ($hasObjective)
        
            {{-- todo Objective --}}
            <div class="mt-10">
            
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