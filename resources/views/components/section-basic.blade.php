<div class="py-12" style="margin-bottom: 160px;">
	<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
		<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
			<div {{ $attributes->merge(["class" => "px-4 py-2"]) }}>
				{{ $slot }}
			</div>
		</div>
	</div>
</div>
