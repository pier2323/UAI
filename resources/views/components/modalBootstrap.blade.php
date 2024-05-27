{{-- * para que haga la funcion del *FADE* --}}
<div class="modal fade" id="register" tabindex="-1" aria-labelledby="register" aria-hidden="true">
  {{-- * para que se muestre --}}
  <div class="modal-dialog" style="max-width: inherit!important">
    {{-- * es el div donde se ve el contenido --}}
    <div class="modal-content mx-auto w-11/12 max-w-lg md:w-2/3">
      {{$header}}
      <div class="relative overflow-hidden rounded border border-gray-400 bg-white px-5 py-8 shadow-md md:px-10">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
