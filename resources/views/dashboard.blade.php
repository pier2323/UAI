<link rel="stylesheet" href="/css/inicio.css" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/carrusel/carusel3.png" class="d-block w-100" alt="1">
            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
    </div>

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




</x-app-layout>
