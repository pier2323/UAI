<div class="py-5">
	
	<button
		class="rounded bg-blue-500 px-4 py-2 text-white"
		wire:click="openModal"
	>
		Open Modal
	</button>
	<x-modal
		:show="$open"
		@close="$open"
		id="my-modal"
		max-width="lg"
	>
		<div>
			{{ $open !== false ?? $open }}
		</div>
		<h1>hello world!</h1>
	</x-modal>
</div>