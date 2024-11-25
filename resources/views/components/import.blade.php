@props(['name' => '', 'list' => []])

@push('script')

    @if (is_array($list))

        @php array_push($list, $name) @endphp

        @vite($list)

    @endif

@endpush
