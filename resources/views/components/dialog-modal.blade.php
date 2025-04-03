@props(['id' => null, 'maxWidth' => null, 'contentAttributes' => []])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        @isset($content)
        <div @foreach ($contentAttributes as $key => $value) {{$key}}="{{$value}}" @endforeach>
            {{ $content }}
        </div>
        @endisset

    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
