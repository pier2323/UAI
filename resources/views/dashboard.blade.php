<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />

                <div class="icono">
                    <a href="{{ route('profile.show') }}">
                        <div class="iconoA">
                            <img src="/images/iconos/administracion.png" width="100px"
                                height="100px"style="margin-left: 75px;margin-right: 80px;">
                        </div>
                    </a>

                    <a href="{{ route('dashboard') }}">
                        <div class="iconoB">
                            <img src="/images/iconos/plan.png" width="84px" height="100px"
                                style="margin-left: 100px;margin-right: 80px;">
                            </button>

                        </div>
                    </a>
                    <a href="{{ route('personal-uai.dashboard') }}">
                        <div class="iconoC">
                            <img src="/images/iconos/personal.png" width="110px"
                                height="100px"style="margin-left: 100px;margin-right: 80px;">
                            </button>

                        </div>
                    </a>
                    <a href="{{ route('dashboard-viejo') }}">
                        <div class="iconoD">
                            <img src="/images/iconos/Actas.png" width="95px"
                                height="100px"style="margin-left: 100px;margin-right: 80px;">
                            </button>

                        </div>
                    </a>
                    <a href="{{ route('dashboard-viejo') }}">
                        <div class="iconoE">
                            <img src="/images/iconos/Actuacion.png" width="110px"
                                height="100px"style="margin-left: 100px;margin-right: 140px;">
                            </button>

                        </div>
                    </a>
                </div>

                <div class="px-4 py-2"  style="padding-top: 130px;margin-top: 70px;">
                    <div class="slide">
                        <div class="slide-inner">
                            <input class="slide-open" type="radio" id="slide-1" name="slide" aria-hidden="true"
                                hidden="" checked="checked">
                            <div class="slide-item">
                                <img src="images/carrusel/PLANIFICACIÓN.png">
                            </div>
                            <input class="slide-open" type="radio" id="slide-2" name="slide" aria-hidden="true"
                                hidden="">
                            <div class="slide-item">
                                <img src="images/carrusel/auditoria(4)(1).jpg">">
                            </div>
                            <input class="slide-open" type="radio" id="slide-3" name="slide" aria-hidden="true"
                                hidden="">
                            <div class="slide-item">
                                <img src="images/carrusel/Diseño.png">
                            </div>
                            <label for="slide-3" class="slide-control prev control-1">‹</label>
                            <label for="slide-2" class="slide-control next control-1">›</label>
                            <label for="slide-1" class="slide-control prev control-2">‹</label>
                            <label for="slide-3" class="slide-control next control-2">›</label>
                            <label for="slide-2" class="slide-control prev control-3">‹</label>
                            <label for="slide-1" class="slide-control next control-3">›</label>
                            <ol class="slide-indicador">
                                <li>
                                    <label for="slide-1" class="slide-circulo">•</label>
                                </li>
                                <li>
                                    <label for="slide-2" class="slide-circulo">•</label>
                                </li>
                                <li>
                                    <label for="slide-3" class="slide-circulo">•</label>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="pie-de-pagina-contenedor">
            <figure>
                <img  src="/images/template/sappp.png" alt="Descripción de la imagen">

            </figure>
            <FONT class="mt-4 text-sm/relaxed " COLOR="white" style="margin-right: 30px;">
                <p   style="margin-right: 30px;">
                    <p>Unidad Auditoria Interna</p>
        
                <p style="margin-left: 45px";>&copy; cantv2024</p>

            </FONT>
        </div>
    </footer>

    <style>
        .pie-de-pagina-contenedor {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #0a4275
        }

        figure {
            margin-left: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            width: 160px;

        }

       

        .icono {
            display: flex;
            margin-top: 50px;
            margin-left: 30px;
            margin-bottom: 30px;
            margin-right: 30px;
        }

        .iconoA img {
            transition: all.5s ease;
        }

        .iconoA img:hover {
            width: 120px;

        }

        .iconoB img {
            transition: all.5s ease;
        }

        .iconoB img:hover {
            width: 100px;

        }

        .iconoC img {
            transition: all.5s ease;
        }

        .iconoC img:hover {
            width: 130px;

        }

        .iconoD img {
            transition: all.5s ease;
        }

        .iconoD img:hover {
            width: 120px;

        }

        .iconoE img {
            transition: all.5s ease;
        }

        .iconoE img:hover {
            width: 130px;

        }




        .slide {
            position: relative;
            box-shadow: 0px 1px 6px rgba(0, 0, 0, 0.64);
            margin-top: 26px;
        }

        .slide-inner {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: calc(300px + 3em);
        }

        .slide-open:checked+.slide-item {
            position: static;
            opacity: 100;
        }

        .slide-item {
            position: absolute;
            opacity: 0;
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }

        .slide-item img {
            display: block;
            height: auto;
            max-width: 100%;
        }

        .slide-control {
            background: rgba(0, 0, 0, 0.28);
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            display: none;
            font-size: 40px;
            height: 40px;
            line-height: 35px;
            position: absolute;
            top: 50%;
            -webkit-transform: translate(0, -50%);
            cursor: pointer;
            -ms-transform: translate(0, -50%);
            transform: translate(0, -50%);
            text-align: center;
            width: 40px;
            z-index: 10;
        }

        .slide-control.prev {
            left: 2%;
        }

        .slide-control.next {
            right: 2%;
        }

        .slide-control:hover {
            background: rgba(0, 0, 0, 0.8);
            color: #aaaaaa;
        }

        #slide-1:checked~.control-1,
        #slide-2:checked~.control-2,
        #slide-3:checked~.control-3 {
            display: block;
        }

        .slide-indicador {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        .slide-indicador li {
            display: inline-block;
            margin: 0 5px;
        }

        .slide-circulo {
            color: #828282;
            cursor: pointer;
            display: block;
            font-size: 35px;
        }

        .slide-circulo:hover {
            color: #aaaaaa;
        }

        #slide-1:checked~.control-1~.slide-indicador li:nth-child(1) .slide-circulo,
        #slide-2:checked~.control-2~.slide-indicador li:nth-child(2) .slide-circulo,
        #slide-3:checked~.control-3~.slide-indicador li:nth-child(3) .slide-circulo {
            color: #428bca;
        }

        #titulo {
            width: 100%;
            position: absolute;
            padding: 0px;
            margin: 0px auto;
            text-align: center;
            font-size: 27px;
            color: rgba(255, 255, 255, 1);
            font-family: 'Open Sans', sans-serif;
            z-index: 9999;
            text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.33),
                -1px 0px 2px rgba(255, 255, 255, 0);
        }
    </style>

</x-app-layout>
