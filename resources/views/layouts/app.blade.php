<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('Sap_UAI', 'Sap_UAI') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  {{-- links styles --}}
  <link rel="stylesheet" href="/css/bootstrap/app.css"/>
  <link rel="stylesheet" href=" /css/bootstrap/styles.css" />
  <link rel="stylesheet" href="./css/bootstrap/all.min.css" />

  {{-- links bootstrap --}}
  <link   rel="stylesheet" href="/css/bootstrap/bootstrap.min.css" >
  <link  rel="stylesheet" href="/css/bootstrap/dataTables.bootstrap5.min.css"/>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  @livewireStyles
</head>

<body class="font-sans antialiased">
  <x-banner />

  <div class="min-h-screen bg-gray-100">
    @livewire('navigation-menu')
    
    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  @stack('modals')

  @livewireScripts
  <!-- Bootstrap-->
  <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="/js/bootstrap/bootstrap.bundle.js"></script>
  <!-- jQuery -->
  <script src="/js/jquery-dataTables/jquery.min.js"></script>
  <!-- DataTable -->
  <script src="/js/jquery-dataTables/jquery.dataTables.min.js"></script>
  <script src="/js/jquery-dataTables/dataTables.bootstrap5.min.js"></script>
</body>

</html>
