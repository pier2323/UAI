@props(['name', 'default' => false, 'width', 'height'])

<div role="chart-{{ $name }}" x-data="{{ $name }}" x-init="start('{{ $name }}')"
x-on:graph-{{$name}}.window="update({ width: '{{ $width }}', height: '{{$height}}' })">

    <x-import name="resources/js/chart.js" />

    <div
    {{-- x-show="graph !== false" --}}
    @if ($default) class="w-64"
    @else {{ $attributes }}
    @endif
    >
        <canvas class="w-64" id="{{ $name }}">lk</canvas>
    </div>
</div>

@script
<script>
Alpine.data('{{ $name }}', () => {
    return {
        canva: null,
        graph: false,

        start(name) {
            this.canva = document.querySelector(`#${name}`);
            if (typeof $wire.config === undefined) {
                alert("$wire.config isn't defined");
                return false;
            }

            this.graph = new chart(this.canva, $wire.config);
        },

        update(resize) {
            this.graph.config.data = $wire.config.data;
            this.graph.width = 250;
            this.graph.height = 250;
            console.log(this.graph)
            console.log($wire.config.data)
            setTimeout(() => {
                this.resize(resize)
            }, 50)
        },

        resize({width, height}) {
            this.graph.canvas.style.width = width;
            this.graph.canvas.style.height = height;
        },
    }
});
</script>
@endscript
