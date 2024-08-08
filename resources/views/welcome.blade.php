<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sap_UAI</title>
    <!-- icono del buscador  -->
    <link rel="shortcut icon" href="/images/template/sappl.png" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/welcome.css" />
    <main>
        <div class="et_pb_bottom_inside_divider"></div>
        <div class="contenedor_nav ">
            <div class="nav_1" id="navbar2">
                <!----------Logo CANTV Blanco-------------------->
                <div class="nav_2">
                    <img src="/images/template/cantv_blanco.png" width="140" height="65" id="navbar3 "style="margin-left: -90px;">
                </div>
                <div class="nav_4">
                    <nav>
                        <ul class="menu-horizontal">
                            <li style="margin-left: 50px;margin-right: 50px;"><a href="#inicio">Inicio</a></li>
                            <li style="margin-right: 50px;">
                                <a href="#">Objectivo</a>
                                <ul style="margin-left: 50px;margin-right: 50px;" class="menu-vertical">
                                    <li><a href="#mision">Mision</a></li>
                                    <li><a href="#mision">Vision</a></li>
                                    <li><a href="#mision">Objetivo</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Nosotros
                                </a>
                                <ul class="menu-vertical">
                                    <li><a href="#organigrama">Oganigrama</a>
                                    </li>
                                </ul>
                            </li>
                            <ul class="menu-horizontal">
                              
                                    <li style="margin-left: 50px;margin-right: 50px;">
                                    <a href="#">Marco Normativo</a>
                                <ul style="margin-left: 50px;margin-right: 50px;" class="menu-vertical">
                                   {{--  <li><a href="{{ route('leyes') }}">Ley</a></li>
                                    <li><a href="{{ route('reglamentos') }}">reglamentos</a></li>
                                    <li><a href="{{ route('documentoNormativo') }}">DocumentoNormativo</a></li> --}}
                                </ul>
                                </li>
                            </ul>


                                <div class="contacto_1"> <a class="pag_1"><i class="fas fa-blog"
                                            style="margin-right: 9px;"></i>
                                        @if (Route::has('login'))
                                            @auth
                                                <a href="{{ url('/dashboard') }}"
                                                    class=" rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                                    <FONT class="mt-4 text-sm/relaxed " COLOR="white">
                                                        Aplicación
                                                    </FONT>
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class=" rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                                    <FONT class="mt-4 text-sm/relaxed " COLOR="white">
                                                        Inicio
                                                    </FONT>
                                                </a>
                                                <div class="div_1"></div>
                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}"
                                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                                        style="margin-right: -100px;">
                                                        <FONT class="mt-4 text-sm/relaxed " COLOR="white">
                                                            Registro
                                                        </FONT>
                                                    </a>
                                                @endif
                                            @endauth
                                        @endif
                                </div>

                            </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="mensaje_1" id="inicio">
            <marquee> ¡Se a Actualizado en 2024! </marquee>
        </div>
        </div>
        <!-------------------- controladores del carrusel -------------------->
        <div class="slider_1">
            <div class="slider_2">
                <div class="slider_completo">
                    <div class="CSSgal">
                        <s id="s1"></s>
                        <s id="s2"></s>
                        <s id="s3"></s>
                        <div class="slider">
                            <!---------------------- letras en movimiento  ---------------------------------->
                            <div id="slider_11">
                                <div class="span" id="sliderValue">
                                </div>
                            </div>
                            <!---------------------- imagenes del carrusel ---------------------------------->
                            <div
                                style="background-image: url(./images/carrusel/carrusel1.jpeg); background-size: cover;">
                            </div>
                            <video src="./images/carrusel/carrusel2.mp4" autoplay="true" muted="true" loop="true"
                                height="300px"></video>
                            <div style="background-image: url(./images/carrusel/carusel3.png); background-size: cover;">
                            </div>
                        </div>
                        <!---------------------- iconos  de las fechas del carrusel  ---------------------------------->
                        <div class="prevNext" style="margin-top: -90px;">
                            <div><a href="#s3" style="margin-left: 8px"><i class="fas fa-angle-left fa-2x"><img
                                            src="/images/iconos/flecha_izquierda.png" style="width: 30px">
                                    </i></a>
                                <a href="#s2" style="margin-right: 20px"><i class="fas fa-angle-right  fa-2x">
                                        <img src="/images/iconos/flecha_Derecha.png" style="width: 30px;"></i></a>
                            </div>
                            <div><a href="#s1" style="margin-left: 8px"><i class="fas fa-angle-left fa-2x"><img
                                            src="/images/iconos/flecha_izquierda.png" style="width: 30px">
                                    </i></a>
                                <a href="#s3" style="margin-right: 20px"><i class="fas fa-angle-right  fa-2x">
                                        <img src="/images/iconos/flecha_Derecha.png" style="width: 30px;"></i></a>
                            </div>
                            <div><a href="#s2" style="margin-left: 8px"><i class="fas fa-angle-left fa-2x"><img
                                            src="/images/iconos/flecha_izquierda.png" style="width: 30px">
                                    </i></a>
                                <a href="#s1" style="margin-right: 20px"><i class="fas fa-angle-right  fa-2x">
                                        <img src="/images/iconos/flecha_Derecha.png" style="width: 30px;"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="mision"></div>
            </div>
            <!-- terminar  los iconos responsil -->
            <!-- iconos de mision ,vison y objectivo -->

            <div class="modu_2">
                <div data-aos="fade-up" class="MODU2 container">
                    <div class="row">
                        <a class="botones_espacio_1">
                            <img src="/images/iconos/Misicion.png" alt="" width="180" height="190">
                            <div class="texto_1"> Misión </div>
                            <div class="novedades_b1">
                                <div class="novedades_b_12">
                                    <div style="margin-left: 15px;">Velar por el patrimonio de la Compañía Anónima
                                        Nacional Teléfonos de Venezuela (Cantv) y sus filiales, mediante la
                                        realización
                                        de
                                        Auditorías Internas, así como el ejercicio de la potestad investigativa
                                        y procedimientos administrativos para la determinación de
                                        responsabilidades y eventuales acciones fiscales.
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="botones_espacio_1">
                            <img src="/images/iconos/Vision.png"alt="" width="180" height="190">
                            <div class="texto_1"> Vision</div>
                            <div class="novedades_b1">

                                <div class="novedades_b_11">
                                    <div style="margin-left: 15px;"> Consolidarse como una dependencia altamente
                                        calificada. de asesoría y apoyo a
                                        la gestión de la Contraloría General de la República y establecerse como
                                        model
                                        para
                                        las Unidades de Auditoría Interna de la
                                        Administración Pública
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="botones_espacio_1">
                        <img src="/images/iconos/objectivo.png"alt="" width="180" height="190">
                        <div class="texto_1"> Objetivo</div>
                        <div class="novedades_b1">

                            <div class="novedades_b_11">
                                <div style="margin-left: 15px;"> Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit. Reprehenderit illum deserunt laborum architecto assumenda amet ad id,
                                    aliquam
                                    obcaecati earum, a odit, quaerat facere. Asperiores, consequuntur. Expedita
                                    distinctio ipsum eum!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Organigrama --}}
            <div id="organigrama"></div>
            <div class="modu_6">
                <svg class="svg3" width="100%" height="100px" viewBox="0 0 1280 140" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g fill="#0C71C3">
                        <path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" />
                        <path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" />
                    </g>
                </svg>
                <div class="Organigrama">

                    <img src="/images/template/Organigrama1.jpg" style="width: 420px;margin-left: 760px;">
                    <h2 style="margin-top: -90px;">Organigrama</h2>
                    <img src="/images/template/Organigrama3.jpg"
                        style="width: 570px; padding-left: 0px;margin-left: 0px;">
                </div>
                {{--     <h1>Organigrama de la UAI</h1> --}}
                <div class="app_extra_cor" data-aos="fade-up" style="margin-top: 0px; ">
                    <div class="caja_enlace_1"></div>
                </div>
                <!------------------------ pie de pagina  ------------------------------------->
            </div>


            <div class="modu_3">
                <svg class="svg3" width="100%" height="100px" viewBox="0 0 1280 140" preserveAspectRatio="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g fill="#0C71C3">
                        <path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" />
                        <path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" />
                    </g>
                </svg>

                <div class="app_extra_cor" data-aos="fade-up">
                    <div class="caja_enlace_1"></div>
                </div>
                <!------------------------ pie de pagina  ------------------------------------->
            </div>
            <div class="modu_4"> Todos los Derechos Reservados / Unidad de Auditoria Interna
                de Privacidad / Aviso Legal </div>
            <div class="modu_5">
                <div class="modu_5_1">
                    <img src="./images/template/mincyt.png" alt="" width="350" height="45">
                </div>
                <div class="modu_5_2">
                    <img src="./images/template/logo2.png" alt="" width="155" height="70">
                </div>
            </div>
            <script src="./js/corporativa/titulo_slider_1.js"></script>
            <script src="./js/corporativa/aos.js"></script>
            <script src="./js/corporativa/flickity.pkgd.min.js"></script>
            <script src="./js/corporativa/jquery-3.6.0.min.js"></script>
            <script src="./js/corporativa/jquery.min.js"></script>
            <script>
                AOS.init();
            </script>
        </div>
    </main>

</html>
