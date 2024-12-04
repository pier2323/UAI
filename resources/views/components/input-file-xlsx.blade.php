@props(['model'])

<div class="flex flex-col flex-grow mb-3">
    <div x-data="{ files: null }" id="FileUpload" class="relative block w-full px-3 py-2 bg-white border-2 border-gray-300 border-solid rounded-md appearance-none hover:shadow-outline-gray">
        <input type="file" accept=".xlsx" wire:model="{{$model}}"
            class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0"
            x-on:change="files = $event.target.files; console.log($event.target.files);"
            x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')"
        >
        <template x-if="files !== null">
            <div class="flex flex-col space-y-1">
                <template x-for="(_,index) in Array.from({ length: files.length })">
                    <div class="flex flex-row items-center space-x-2">
                        <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                        {{-- <span class="self-end text-xs text-gray-500" x-text="filesize(files[index].size)">...</span> --}}
                    </div>
                </template>
            </div>
        </template>
        <template x-if="files === null">
            <div class="flex flex-col items-center justify-center space-y-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#434343">
                    <path d="M452-202h60v-201l82 82 42-42-156-152-154 154 42 42 84-84v201ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h361l219 219v521q0 24-18 42t-42 18H220Zm331-554v-186H220v680h520v-494H551ZM220-820v186-186 680-680Z"/>
                </svg>
                <p class="text-gray-700">
                    Arrastra y suelta el archivo aquí, o haz clic para seleccionarlo
                </p>
                <a href="javascript:void(0)" class="flex items-center px-4 py-2 mx-auto font-medium text-center text-white bg-blue-700 border border-transparent rounded-md outline-none">Elige un archivo</a>
            </div>
        </template>
    </div>
</div>
