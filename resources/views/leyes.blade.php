{{-- distribución --}}
{{-- Diseño de pagina --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sap_UAI</title>
    <!-- icono del buscador  -->
    <link rel="shortcut icon" href="/images/template/sappl.png" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/ley.css" />
    <link rel="stylesheet" href="/css/bootstrap.ley.css" />

</head>
<div class="et_pb_bottom_inside_divider"></div>
<div class="contenedor_nav ">
    <div class="nav_1" id="navbar2">
        <!----------Logo CANTV Blanco-------------------->
        <div class="nav_2">
            <img src="/images/template/cantv_blanco.png" width="140" height="65"
                id="navbar3 "style="margin-left: -90px;">
        </div>
        <div class="nav_4">
            <nav>
                <ul class="menu-horizontal">
                    <li style="margin-left: 50px;margin-right: 50px;"><a href="{{ route('welcome') }}">Inicio</a></li>
                    <ul class="menu-horizontal">

                        <li style="margin-left: 50px;margin-right: 50px;">
                            <a href="#">Marco Normativo</a>
                            <ul style="margin-left: 50px;margin-right: 50px;" class="menu-vertical">
                                <li><a href="{{ route('leyes') }}">Leyes</a></li>
                                <li><a href="{{ route('reglamentos') }}">Reglamentos</a></li>
                                <li><a href="{{ route('documentoNormativo') }}">Documento Normativo</a></li>
                            </ul>
                        </li>
                    </ul>
            </nav>
        </div>
    </div>
</div>

<body
    class="site com-phocadownload view-category no-layout no-task itemid-178 es-es ltr  sticky-header layout-fluid off-canvas-menu-init">

    </header>
    {{-- baner  morado --}}


    <div class="mensaje_2 ">
        <h3 style="margin-right: 50px;">Leyes<h3></h3>
    </div>


    {{-- baner morado --}}
    <section id="sp-main-body0" style="padding-top: 75px;">
        <div class="container">
            <div class="row">
                <div id="sp-component" class="col-sm-12 col-md-12">
                    <div class="sp-column ">
                        <div id="system-message-container">
                        </div>
                        <div id="phoca-dl-category-box" class="pd-category-view">
                            <div class="pd-category">
                                <h3  class="ph-subheader pd-ctitle">Leyes</h3>
                                <div class="pd-filebox">
                                    <div class="pd-filenamebox">
                                        <div class="pd-filename">
                                            <div class="pd-document16"
                                                style="background: url('https://www.cnti.gob.ve/media/com_phocadownload/images/mime/16/icon-pdf.png') 0 center no-repeat;">
                                                <div class="pd-float"><a class=""
                                                        href="/ley/Normas Generales de Auditoría de Estado -1.pdf"
                                                        download="Normas Generales de Auditoría de Estado">Normas Generales de Auditoría de Estado<Label></Label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pd-buttons">
                                        <div class="pd-button-download"><a class="btn btn-success"
                                                href="/ley/Normas Generales de Auditoría de Estado -1.pdf"
                                                download="Normas Generales de Auditoría de Estado">Descargar</a>
                                        </div>
                                    </div>
                                    <div class="pd-fdesc">
                                        <p> República Bolivariana de Venezuela Contraloría General de la República</p>
                                        <p>Gaceta Oficial Nº 40.172 del 22 de mayo de 2013</p>
                                    </div>
                                    <div class="pd-cb"></div>
                                </div>


                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer></x-footer>

</body>
