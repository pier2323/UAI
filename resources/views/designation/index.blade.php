<x-app-layout>

  <link rel="stylesheet"
    href="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/css/main.ad49aa9b.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />


  <form action="{{ route('designation.download') }}" method="POST">
    @csrf
    @method('POST')

    <div x-data="data()">
      <template x-for="(input, index) in Array.from({length: inputs})" :key="index">
        <div>
          <select name="auditor[]" :id="'input-' + index">
            @foreach ($personal as $person)
              <option value="{{ $person->id }}">{{ "$person->primer_nombre $person->primer_apellido" }}</option>
            @endforeach
          </select>
          <select name="cargo[]" :id="'input-' + index">
            <option value="auditor">Auditor</option>
            <option value="coordinador">Coordinador</option>
          </select>
        </div>
      </template>

      <div style="width: 50%!important" class="flex w-6/12 flex-col items-center justify-center">
        <div
          class="!z-5 shadow-3xl shadow-shadow-500 3xl:p-![18px] undefined relative flex flex w-full max-w-[300px] flex-col flex-col rounded-[20px] bg-white bg-white bg-clip-border !p-6 md:max-w-[400px]">
          <div class="mb-3 flex flex-col">
            <button @click.prevent="addInput"
              class="rounded-l bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400">
              +
            </button>
            <button @click.prevent="removeInput"
              class="rounded-r bg-gray-300 px-4 py-2 font-bold text-gray-800 hover:bg-gray-400">
              -
            </button>
            <button
              class="select-none rounded-lg bg-gray-900 px-6 py-3 text-center align-middle font-sans text-xs font-bold uppercase shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="submit">
              Button
            </button>

          </div>

        </div>
      </div>
    </div>
    <div>
      <label for="planificacion">planificacion</label>
      <input type="date" name="planificacion" id="planificacion">
    </div>
    <div>
      <label for="ejecucion">ejecucion</label>
      <input type="date" name="ejecucion" id="ejecucion">
    </div>
    <div>
      <label for="preeliminar">preeliminar</label>
      <input type="date" name="preeliminar" id="preeliminar">
    </div>
    <div>
      <label for="descargo">descargo</label>
      <input type="date" name="descargo" id="descargo">
    </div>
    <div>
      <label for="definitivo">definitivo</label>
      <input type="date" name="definitivo" id="definitivo">
    </div>









    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <div class="text-center mt-20">
        <lable class="text-lg font-semibold">Choose Date</lable> <br>
        <input id="datepicker" class="border-2 border-gray-300 rounded px-3 py-2 w-56" type="text"
            placeholder="Select a date">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
    </script>









  </form>

  <script>
    function data() {
      return {
        inputs: 1,
        addInput() {
          this.inputs++;
        },
        removeInput() {
          if (this.inputs > 1) {
            this.inputs--;
          }
        }
      }
    }
  </script>
</x-app-layout>
