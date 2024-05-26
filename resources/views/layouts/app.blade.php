<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="shortcut icon" href="/images/template/sappl.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('Sap_UAI', 'Sap_UAI') }}</title>
    {{-- * links styles --}}
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/bootstrap/app.css" />
    <link rel="stylesheet" href="/css/bootstrap/styles.css" />
    <link rel="stylesheet" href="/css/bootstrap/all.min.css" />

    {{-- * links bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap/dataTables.bootstrap5.min.css" />

    {{-- * Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- * Styles library --}}
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
</head>

<body class="font-sans antialiased">
    <x-default.banner />

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
</body>
</html>
