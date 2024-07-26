<x-action-message class="absolute justify-self-center bottom-5 left-0 right-0 w-3/4 opacity-85"  {{ $attributes }}>
<div role="alert" id="notificacion-error" class="block px-4 py-4 text-base text-white bg-gray-900 rounded-lg font-regular">
  <div class="flex justify-center ">
        {{ $slot }}
    </div>
</div>
</x-action-message>