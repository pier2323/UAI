<article
    class="card group flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-500 text-slate-700 dark:border-slate-700  dark:text-slate-300">
    <div class="h-5 overflow-hidden">
    </div>
    <div class="flex flex-col gap-4 p-6">
        <h3 class="titulo " aria-describedby="featureDescription"> {{ $titulo }}</h3>
        <p id="featureDescription" class="text-pretty text-sm">
            {{ $des }}


        </p>
    </div>

    <style>
        .card {
            background: linear-gradient(to right, #1D4ED8, #c471ed);
            /* Degradado inicial */
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease-in-out;
        }

        .card:hover {
            background: linear-gradient(to left,  #1D4ED8, #c471ed);
            /* Degradado invertido */
        }
    </style>
</article>
