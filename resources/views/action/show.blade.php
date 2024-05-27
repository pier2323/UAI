@php
$action = (object) 
[
  'id' => '1',
  'target' => 'Evaluar la factibilidad tecnica del proyecto caracas-laguaira',
  'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis odit, illum rem repudiandae corrupti odio quisquam autem numquam quas deserunt! Obcaecati temporibus dolore cum porro itaque perferendis vero consequatur qui.',
  'planningStart' => "15/05/2024",
  'planningEnd' => "15/05/2024",
  'planningDays' => "15/05/2024",
  'executingStart' => "15/05/2024",
  'executingEnd' => "15/05/2024",
  'executingDays' => "15/05/2024",
  'preliminaryStart' => "15/05/2024",
  'preliminaryEnd' => "15/05/2024",
  'preliminaryDays' => "15/05/2024",
  'downloadStart' => "15/05/2024",
  'downloadEnd' => "15/05/2024",
  'downloadDays' => "15/05/2024",
  'definitiveStart' => "15/05/2024",
  'definitiveStart' => "15/05/2024",
  'definitiveStart' => "15/05/2024",
];
@endphp

<x-app-layout>
	<x-section-basic class="flex flex-row">
		<div class="card">
			<h4 class="card-header">{{ $action->target }}</h4>
			<div class="card-body">
				<p class="card-text">{{$action->description}}</p>
			</div>
		</div>
    <x-library.calendar />
	</x-section-basic>
</x-app-layout>
