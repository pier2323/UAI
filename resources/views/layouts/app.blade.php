<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="shortcut icon" href="/images/template/sappl.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('Sap_UAI', 'Sap_UAI') }}</title>
    {{-- * links styles --}}
    <link rel="stylesheet" href="/css/bootstrap/app.css" />
    <link rel="stylesheet" href="/css/bootstrap/styles.css" />
    <link rel="stylesheet" href="/css/bootstrap/all.min.css" />

    {{-- * links bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap/dataTables.bootstrap5.min.css" />

    {{-- * Scripts --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- * Styles library --}}
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="/css/intlTelInput.css">
    @livewireStyles
    {{-- * Bootstrap --}}
    <script defer src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script defer src="/js/bootstrap/bootstrap.bundle.js"></script>
    <!-- jQuery -->
    <script defer src="/js/jquery-dataTables/jquery.min.js"></script>
    <!-- DataTable -->
    <script defer src="/js/jquery-dataTables/jquery.dataTables.min.js"></script>
    <script defer src="/js/jquery-dataTables/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        {{-- * Page Content --}}
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <x-footer></x-footer>


    @stack('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.j1s"></script>

</body>

</html>
