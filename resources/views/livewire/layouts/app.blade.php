<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="shortcut icon" href="/images/template/sappl.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <title>{{ config('Sap_UAI', 'Sap_UAI') }}</title> --}}
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
        @vite(['resources/js/hola.js'])

    
        {{-- * Styles library --}}
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
        @livewireStyles
        {{-- * Bootstrap --}}
        <script defer src="/js/bootstrap/bootstrap.bundle.min.js"></script>
        <script defer src="/js/bootstrap/bootstrap.bundle.js"></script>
        <!-- jQuery -->
        <script defer src="/js/jquery-dataTables/jquery.min.js"></script>
        <!-- DataTable -->
        <script defer src="/js/jquery-dataTables/jquery.dataTables.min.js"></script>
        <script defer src="/js/jquery-dataTables/dataTables.bootstrap5.min.js"></script>   
        @stack('styles')     
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
    
            {{-- * Page Content --}}
            <main>
                {{ $slot }}
            </main>
        </div>
        
        <div role="alert" class="fixed flex flex-col bottom-10 right-10">
            @stack('alert')     
        </div>
        
        @stack('modals')
    
        @livewireScripts
        
        @stack('script')     

        <x-footer></x-footer>
    </body>
</html>



