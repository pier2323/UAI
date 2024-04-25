<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <html>

  <head>
    <link rel="stylesheet"
      href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
  </head>

  <body>
    <div style="width: 50%!important" class="flex w-6/12 flex-col items-center justify-center">
      <div
        class="!z-5 shadow-3xl shadow-shadow-500 3xl:p-![18px] undefined relative flex flex w-full max-w-[300px] flex-col flex-col rounded-[20px] bg-white bg-white bg-clip-border !p-6 md:max-w-[400px]">

        <div class="mb-3 flex flex-col">
          <select name="auditores" id="">
            @foreach ($personal as $person)
              <option value="{{ $person->id }}">{{ "$person->primer_nombre $person->primer_apellido" }}</option>
            @endforeach
          </select>

          <button
            class="middle none center rounded-lg bg-pink-500 px-6 py-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true">+</button>

          <button
          class="middle none center rounded-lg mb-3 bg-pink-500 px-6 py-3 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
          data-ripple-light="true">
          enviar
        </button>

        </div>
      </div>
    </div>
  </body>

  </html>
</body>

</html>

{{-- <label for="email" class="text-navy-700 text-sm font-bold dark:text-white">Default</label>
  <input type="text" id="email" placeholder="@horizon.ui"
    class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border border-gray-200 bg-white/0 p-3 text-sm outline-none"> --}}
{{-- </div> --}}
{{-- <div class="mb-3">
  <label for="email2" class="text-navy-700 text-sm font-bold dark:text-white">Success</label>
  <input type="text" id="email2" placeholder="Success input"
    class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border border-green-500 bg-white/0 p-3 text-sm text-green-500 outline-none placeholder:text-green-500 dark:!border-green-400 dark:!text-green-400 dark:placeholder:!text-green-400">
</div> --}}
{{-- <div class="mb-3">
  <label for="email3" class="text-navy-700 text-sm font-bold dark:text-white">Error</label>
  <input type="text" id="email3" placeholder="Error input"
    class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border border-red-500 bg-white/0 p-3 text-sm text-red-500 outline-none placeholder:text-red-500 dark:!border-red-400 dark:!text-red-400 dark:placeholder:!text-red-400">
</div> --}}
{{-- <div>
  <label for="email4" class="text-navy-700 text-sm font-bold dark:text-white">Disabled</label>
  <input disabled="" type="text" id="email4" placeholder="@horizon.ui"
    class="mt-2 flex h-12 w-full cursor-not-allowed items-center justify-center rounded-xl border !border-none !bg-gray-100 bg-white/0 p-3 text-sm outline-none dark:!bg-white/5">
</div> --}}
