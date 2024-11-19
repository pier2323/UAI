@props(['exception' => true, 'custom' => null])

@if ($custom ?? $errors->any() && $exception)
<div class="relative px-4 py-3 mt-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
    <strong class="font-bold">Error!</strong>
    <br>
    <ul>
        @foreach ($custom ?? $errors->all() as $error)
            <li>
                <span class="block sm:inline">{{$error}}</span>
            </li>
        @endforeach
    </ul>
</div>
@endif
