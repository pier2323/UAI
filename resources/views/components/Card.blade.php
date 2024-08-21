<article 
    class="card group flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-500 bg-slate-100 text-slate-700 dark:border-slate-700 bg-blue-900 dark:text-slate-300">
    <div class="h-5 overflow-hidden">
    </div>
    <div class="flex flex-col gap-4 p-6">
        <h3 class="titulo "
            aria-describedby="featureDescription"> {{ $titulo }}</h3>
        <p id="featureDescription" class="text-pretty text-sm">
            {{ $des }}


        </p>
    </div>

    <style>
        .card:hover {
            box-shadow: 0 8px 16px 0 rgb(255, 0, 0);
            transform: translateY(-5px);
            background-color: #00438A;
            /* Cambia el color de fondo al pasar el cursor */
        }

        .titulo {

            text-transform: capitalize;
            border-bottom: 2px solid black;
            text-align: center; 

        }
    </style>
</article>
