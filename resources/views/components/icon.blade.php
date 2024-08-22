@props([
    'name', 
    'type' => 'baseline', 
    'figure' => 'inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200', 
    'img' => 'w-full h-full'
])

<figure class="{{ $figure }}">
    <img alt="{{ $name }}" class="{{ $img }}" src="{{ Vite::asset("resources/img/svg/$name/$type.svg") }}">
    @if (isset($figcaption)) 
        <figcaption>$figcaption</figcaption> 
    @endif
</figure>
