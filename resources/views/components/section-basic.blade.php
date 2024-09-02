<div class="py-12">
	<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
		<div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
			<div class="px-4 py-4">
				<div {{ $attributes->merge(["class" => "mb-4"]) }}>
					{{ $slot }}
					@isset($article)
						{{ $article }}
					@endisset
				</div>

				@isset($footer)
					<hr>
					<div class="mt-3">
						{{ $footer }}
					</div>
				@endisset
			</div>
		</div>
	</div>
</div>
