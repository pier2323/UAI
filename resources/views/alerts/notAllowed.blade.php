@session('notAllowed')
    <x-alert theme="error">
        <strong>Error:</strong>
        <span>{{session('notAllowed')}}</span>
    </x-alert>
@endsession