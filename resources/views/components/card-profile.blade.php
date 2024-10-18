@props([
    'profile_photo' => \App\Models\Employee::find(1)->profile_photo,
    'fullName' => 'Jenbluk Vanegas', 
    'jobTitle' => 'Auditor Interno',
    ]
)

@php
    $class = 'flex flex-col items-center justify-center w-48 h-56 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700';
@endphp


<div x-bind:id="'card-'+index" {{ $attributes->merge(['class' => $class]) }}>

    {{$slot}}

    {{-- todo content --}}
    <div class="flex flex-col items-center justify-center pb-2">

        {{-- todo profile photo --}}
        <img class="w-5/12 mb-3 rounded-full shadow-lg " :src="'{{ Storage::url('public/employees/profile-photo/') }}' + card.data.profile_photo" alt="Bonnie image"/>

        {{-- todo Full name --}}
        <h5 class="text-base font-medium text-center text-gray-900 dark:text-white" x-text='card.data.first_name + " " + card.data.first_surname'></h5>

        {{-- todo job title --}}
        <span class="text-sm text-gray-500 dark:text-gray-400 mt-0.5" x-text="card.data.job_title.name"></span>

    </div>
    
</div>