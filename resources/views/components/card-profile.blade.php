@props([
    'profile_photo' => \App\Models\Employee::find(1)->profile_photo,
    'fullName' => 'Jenbluk Vanegas', 
    'jobTitle' => 'Auditor Interno',
    ]
)

@php
    $class = 'mr-4 mb-4 w-full h-72 max-w-64 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700';
@endphp


<div 
x-bind:id="'card-'+index" 
{{ $attributes->merge(['class' => $class]) }}
>



    {{$slot}}

    {{-- todo content --}}
    <div class="flex flex-col items-center pb-6">

        {{-- todo profile photo --}}
        <img class="w-40 h-40 mb-3 rounded-full shadow-lg" :src="employees[index].profile_photo" alt="Bonnie image"/>

        {{-- todo Full name --}}

        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" x-text='employees[index].first_name + " " + employees[index].first_surname'></h5>

        {{-- todo job title --}}
        <span class="text-sm text-gray-500 dark:text-gray-400" x-text="employees[index].job_title.name"></span>


        {{-- <div class="flex mt-4 md:mt-6">
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
            <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</a>
        </div> --}}


        <script>
        
        </script>
    </div>
</div>