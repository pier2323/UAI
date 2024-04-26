<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sap_UAI</title>
    <link rel="shortcut icon" href="/images/template/logo_azul.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/welcome.css" />
    <script src="/js/welcome.js"></script>
    <main>
        <div class="et_pb_bottom_inside_divider"></div>

        <div class="contenedor_nav">


            <div class="nav_1" id="navbar2">

                <!----------Logo CANTV-------------------->
                <div class="nav_2">
                    <img src="/images/template/sappp.png" width="140" height="65" id="navbar3">
                </div>
                <!----------Soporte Aplicaciones---------->

                <!---------- panel de navegacion ------------>

                <!------------------------------------------->

                <!----------Soporte Canaima--------------->

                <!----------Imagenes Corporativas------------>

                <!-------------------------------------------->
                <div class="nav_4">

                    <!-- partial:index.partial.html -->
                    <div class="contacto_1"> <a class="pag_1"><i class="fas fa-blog" style="margin-right: 8px;"></i>
                            @if (Route::has('login'))

                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        <FONT class="mt-4 text-sm/relaxed " COLOR="white">
                                            Inicio
                                        </FONT>
                                    </a>
                                    <div class="div_1"></div>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                            style="margin-right: -100px;">
                                            <FONT class="mt-4 text-sm/relaxed " COLOR="white">
                                                Registro
                                            </FONT>
                                        </a>
                                    @endif
                                @endauth

                            @endif

                    </div>
                    <!---   <script>
                        $(document).ready(function() {
                            const suggestions = [

                                //Listado Aplicaciones Corporativa
                                {
                                    text: "Autocad 2021",
                                    link: "Paginacion_Menu/Aplicaciones_Corporativas_Autocad2021.html"
                                },


                                // ... puedes agregar más sugerencias según tus necesidades
                            ];

                            const searchInput = $(".field input");
                            const suggestionsContainer = $(".suggestions-container");
                            const scrollableContainer = $("#miScrollableContainer ul");

                            let isMouseDown = false;
                            let startY, startScrollTop;

                            function showSuggestions() {
                                const inputValue = searchInput.val().toLowerCase();
                                const filteredSuggestions = suggestions.filter(suggestion =>
                                    suggestion.text.toLowerCase().includes(inputValue)
                                );

                                const suggestionList = filteredSuggestions.map(suggestion =>
                                    `<li class="suggestion" style="justify-content: center; align-items: center;"><i class="material-symbols-outlined">search</i><a style="color:black;" href="${suggestion.link}" target="_blank">${suggestion.text}</a></li>`
                                );

                                suggestionsContainer.html(
                                    `<div class="scrollable-container" id="miScrollableContainer"><ul>${suggestionList.join('')}</ul></div>`
                                );
                                suggestionsContainer.toggleClass("show", filteredSuggestions.length > 0);

                                scrollableContainer.on('mousedown', function(e) {
                                    isMouseDown = true;
                                    startY = e.clientY;
                                    startScrollTop = scrollableContainer.scrollTop();
                                });

                                $(document).on('mousemove', function(e) {
                                    if (!isMouseDown) return;

                                    const deltaY = e.clientY - startY;
                                    scrollableContainer.scrollTop(startScrollTop - deltaY);
                                });

                                $(document).on('mouseup', function() {
                                    isMouseDown = false;
                                });
                            }

                            searchInput.on('input', showSuggestions);

                            $(document).on('click', function(event) {
                                if (!$(event.target).closest('.search').length) {
                                    suggestionsContainer.removeClass("show");
                                }
                            });
                        });
                    </script>-------->

                </div>

            </div>



        </div>



        <!-------------------- Modulo 3 iconos circulares -------------------->

        <div class="slider_1">




            <div class="slider_2">




                <div class="slider_completo">

                    <div class="CSSgal">

                        <s id="s1"></s>
                        <s id="s2"></s>
                        <s id="s3"></s>

                        <div class="slider">

                            <!----------------------  Titulo de slider  ---------------------------------->
                            <div style="background-image: url(./images/template/cantv.png); background-size: cover;">
                            </div>


                            <!---------------------------------------------------------------------------->

                            <!-- Slider 2 -->

                            <div
                                style="background-image: url(./img/Banwer-web-1920px-X-1280px-azul.jpg); background-size: cover;">
                            </div>

                            <!------------------------------------------------------------->

                            <!-- Slider 3-->

                            <div style="background-image: url(./img/div3/1.png); background-size: cover;">
                            </div>
                            <!------------------------------------------------------------->
                            <!-- Slider 4-->
                            <!--------<   div style="background-image: url(./img/div3/1.png); background-size: cover;"></div>
                            ----------------------------------------------------->

                            <!-- Funcionamiento del slider-->
                               <!-- Ponerle margen asia riba-->
                        </div>
                        
                        <div class="prevNext">
                            <div><a href="#s3"><i class="fas fa-angle-left fa-2x" style="color: #ffffffd1;"> < </i></a>
                                <a href="#s2"><i class="fas fa-angle-right  fa-2x"style="color: #ffffffd1;"> > </i></a>
                            </div>
                            <div><a href="#s1"><i class="fas fa-angle-left fa-2x" style="color: #e61515d1;"> < </i></a>
                                <a href="#s3"><i class="fas fa-angle-right  fa-2x"
                                        style="color: #ff0202d1;"> > </i></a>
                            </div>
                            <div><a href="#s2"><i class="fas fa-angle-left fa-2x" style="color: #ffffffd1;"> < </i></a>
                                <a href="#s1"><i class="fas fa-angle-right  fa-2x"
                                        style="color: #ffffffd1;"> > </i></a>
                            </div>
                           
                    </div>
                </div>
            </div>
        </div>



        <div class="modu_2">

            <svg class="svg2" width="100%" height="173px" viewBox="0 0 1280 140" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <g fill="#0C71C3">
                    <path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" />
                    <path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" />
                </g>
            </svg>

            <div data-aos="fade-up" class="MODU2">

                <a href="http://devintra/cic/PlanillasCIC_Portal/menu.asp" class="botones_espacio_1">

                    <img src="./img/cic.png" alt="" width="180" height="190">
                    <div class="texto_1"> Servicios CIC</div>

                    <div class="novedades_b1">

                        <div class="novedades_b_11">
                            <div style="margin-left: -20px;"> Si presenta algún tipo de falla, </div>
                            <div style="margin-left: -16px;"> comuníquese al CIC a través del <div
                                    style="color: #ffcc00;"> 500-8745 </div>
                            </div>
                            <div style="margin-left: 5px;"> Haga click para acceder a su portal..</div>
                        </div>

                    </div>

                </a>




                <div class="botones_espacio_2">

                    <img src="./img/novedades.png" alt="" width="180" height="190">
                    <div class="texto_1"> Novedades</div>

                    <div class="novedades_b">

                        <a href="./Paginacion_Menu/Aplicaciones_Corporativas_MaprexPlus.html" class="novedades_b_1"
                            style="border-top-right-radius:10px; border-top-left-radius:10px;">Actualización
                            de
                            Maprex</a>
                        <a href="./Paginacion_Menu/Aplicaciones_Corporativas_Soporte_Remoto.html"
                            class="novedades_b_1">Soporte Remoto 21/06/2021</a>
                        <a href="http://corporativa/Download/Drivers/Impresoras/Delcop/Lexmark_Universal.rar"
                            class="novedades_b_1">Controlador Universal Lexmark 26/10/2021</a>
                        <a href="http://corporativa/Download/Drivers/Impresoras/Delcop/MFP_526-20220421T183833Z-001.zip"
                            class="novedades_b_1">Controlador Delcop MFP_526 21/04/2022</a>
                        <a href="http://corporativa/Download/Aplicaciones/FirefoxParaSacas/Firefox Setup 72.0.2.exe"
                            class="novedades_b_1">Mozilla Firefox 72.0.2 (Para sacas y boss)</a>
                        <a href="Paginacion_Menu/Aplicaciones_Corporativas_Oracle9i.html" class="novedades_b_1"
                            style="border-bottom-right-radius:10px; border-bottom-left-radius:10px;">Oracle9i</a>
                    </div>
                </div>


                <a class="botones_espacio_2" href="./index.html" id="res_ico_1">

                    <img src="./img/controlInventario.png" alt="" width="180" height="190">
                    <div class="texto_1"> Control Inventario</div>


                </a>



                <a class="botones_espacio_2" href="./Paginacion_Menu/Aplicaciones_Corporativas_Impresoras.html">

                    <img src="./img/impresora5555.png" alt="" width="180" height="190">
                    <div class="texto_1"> Impresoras</div>


                </a>





            </div>

        </div>

        <!-------------------------------------------------------------->


        <div class="modu_3">

            <svg class="svg3" width="100%" height="100px" viewBox="0 0 1280 140" preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg">
                <g fill="#0C71C3">
                    <path d="M1280 0l-266 91.52a72.59 72.59 0 0 1-30.76 3.71L0 0v140h1280z" fill-opacity=".5" />
                    <path d="M1280 0l-262.1 116.26a73.29 73.29 0 0 1-39.09 6L0 0v140h1280z" />
                </g>
            </svg>

            <div class="app_extra_cor" data-aos="fade-up">
                <div class="caja_enlace_1">

                    <div class="titulos_enlaces_1">Aplicativos</div>
                    <a href="http://corporativa.cantv.com.ve/Paginacion_Menu/Aplicaciones_Corporativas_MaprexPlus.html"
                        class="titulos_enlaces_2">Maprex Plus</a>
                    <a href="http://corporativa/Download/Desasistidos/SoporteRemoto/new/SoporteRemotoUVNC24112021.rar"
                        class="titulos_enlaces_2">Soporte Remoto</a>
                    <a href="http://corporativa/Download/Aplicaciones/FirefoxParaSacas/Firefox Setup 72.0_32BIT.exe"
                        class="titulos_enlaces_2">Mozilla Firefox 72.0.2 Sacas</a>
                    <a href="Paginacion_Menu/Aplicaciones_Corporativas_Oracle9i.html"
                        class="titulos_enlaces_2">Oracle9i</a>


                    <div class="titulos_enlaces_1">GNU/LINUX</div>
                    <a href="http://corporativa/Download/Herramientas/Software%20Libre/Libreoffice/LibreOffice_7.2.2_Win_x86.msi"
                        class="titulos_enlaces_2">Libre Office 7.2.2 32bit</a>
                    <a href="http://corporativa/Download/Herramientas/Software%20Libre/Libreoffice/LibreOffice_7.2.2_Win_x64.msi"
                        class="titulos_enlaces_2">Libre Office 7.2.2 64bit</a>

                    <div class="titulos_enlaces_1">Controladores Imp.</div>
                    <a href="http://corporativa/Download/Drivers/Impresoras/Delcop/Lexmark_Universal.rar"
                        class="titulos_enlaces_2">Universal Lexmark </a>



                </div>
                <div class="caja_enlace_2">

                    <div class="titulos_enlaces_1">Formatos</div>
                    <a href="http://corporativa.cantv.com.ve/Planillas_y%20Solicitudes_.html"
                        class="titulos_enlaces_2">Plantillas y Solicitudes</a>
                    <a href="http://corporativa.cantv.com.ve/Normativas.html" class="titulos_enlaces_2">Normativas</a>

                    <div class="titulos_enlaces_1">Canaima</div>
                    <a href="./Manuales.html" class="titulos_enlaces_2">Manuales</a>

                    <div class="titulos_enlaces_1" style="margin-left:10px;">Archivos rar</div>
                    <a href="http://corporativa/Download/Aplicaciones/Archivosrar/OCSNG-CANTV-Windows-7-10-Agent-2.3.0.0.rar"
                        class="titulos_enlaces_2" style="margin-left:10px;"> OCSNG Win 7, 10 Agent 2.3.0.0
                    </a>
                    <a href="http://corporativa/Download/Aplicaciones/Archivosrar/OCSNG-CANTV-Windows-XP-Agent-2.1.1.1.rar"
                        class="titulos_enlaces_2" style="margin-left:10px;"> OCSNG Win XP Agent 2.1.1.1
                    </a>


                </div>


                <div class="caja_enlace_3">

                    <div class="titulos_enlaces_1">Imagenes Corp.</div>
                    <a href="http://corporativa.cantv.com.ve/Paginacion_Menu/Imagenes_Corporativas_Equipos_Escritorio.html"
                        class="titulos_enlaces_2">Equipo de Escritorio</a>
                    <a href="http://corporativa.cantv.com.ve/Paginacion_Menu/Imagenes_Corporativas_Equipos_Portatiles.html"
                        class="titulos_enlaces_2">Equipos Portatiles</a>


                </div>




            </div>
            <!------------------------ Modulo de Siguenos ------------------------------------->
            <div class="redes_extras" data-aos="fade-up">

                <div class="sig">Síguenos</div>

                <div class="sig_2">

                    <a href="https://www.instagram.com/contactocantv/" style="color: white;" id="instagram_1">
                        <i class="fab fa-instagram" id="instagram_1" style="margin-left: 30px;"></i>
                    </a>

                    <a href="https://twitter.com/salaprensaCantv" style="color: white;" id="twitter_1">
                        <i id="twitter_1" class="material-symbols-outlined"
                            style="margin-left: 28px; margin-top: -2px;">close</i>
                    </a>

                    <a href="https://www.youtube.com/user/Cantvsalaprensa" style="color: white;" id="youtube_1">
                        <i id="youtube_1" class="fab fa-youtube" style="margin-left: 18px;"></i>
                    </a>

                    <a href="https://www.facebook.com/ConexionCulturalCantv" style="color: white;" id="facebook_1">
                        <i id="facebook_1" class="fab fa-facebook-f" style="margin-left: 30px;"></i>
                    </a>

                </div>

            </div>
            <!---------------------------------------------------------------------------------->
        </div>

        <div class="modu_4"> Todos los Derechos Reservados / Desarrollado por GOTID - GEYPTI © 2024 /
            Políticas
            de Privacidad / Aviso Legal </div>

        <div class="modu_5">

            <div class="modu_5_1">

                <img src="./img/mincyt.png" alt="" width="350" height="45">

            </div>
            <div class="modu_5_2">

                <img src="./img/logo2.png" alt="" width="155" height="70">

            </div>
        </div>
        <script src="js/main.js"></script>
        <script src="./js/titulo_slider_1.js"></script>
        <script src="js/popup.js"></script>
        <script src="js/popup2.js"></script>
        <script src="js/popup3.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/slider.js"></script>
        <script src="js/particles.min.js"></script>
        <script src="js/app6_inicio.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src="js/script_barra_de_busqueda.js"></script>
        <script src="js/script_barra_lista.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/codigo.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.pkgd.min.js'></script>
        <script src="./js/style_slider_cor.js"></script>


        <script>
            AOS.init();
        </script>


        <script src="./js/efecto_barra_nav.js"></script>



        </body>

</html>
