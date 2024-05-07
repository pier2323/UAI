<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link rel="shortcut icon" href="/images/template/sappl.png"  />
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
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  {{-- * Styles library --}}
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

 {{---poner en otra pagina diferente--}}

  <svg class="svg3" width="100%" height="100px" viewBox="0 0 1280 140" preserveAspectRatio="none"
  xmlns="http://www.w3.org/2000/svg">
  <g fill="#0C71C3">
      <path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" />
      <path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" />
  </g>
</svg>

  <div class="modu_4"> Todos los Derechos Reservados / Unidad de Auditoria Interna
    de Privacidad / Aviso Legal </div>

<div class="modu_5">

    <div class="modu_5_1">

        <img src="./images/template/mincyt.png" alt="" width="350" height="45">

    </div>
    <div class="modu_5_2">

        <img src="./images/template/logo2.png" alt="" width="155" height="70">

    </div>
</div>
</body>

</html>
