# Dependencias del Proyecto SAP UAI

## Resumen del Proyecto

El proyecto SAP UAI, desarrollado por la Unidad de Auditoría Interna de CANTV, es una solución integral para la gestión y automatización de los procesos de auditoría. Facilita la administración, almacenamiento y automatización de los papeles de trabajo, así como la gestión del personal y el seguimiento de su progreso.

## Dependencias Backend (Laravel)

| Dependencia | Versión | Tipo | Notas |
|---|---|---|---|
| PHP | ^8.2 | Lenguaje |  |
| ext-fileinfo | * | Extensión PHP |  |
| ext-gd | * | Extensión PHP |  |
| dompdf/dompdf | ^3.0 | Librería PHP | Generación de PDFs |
| guzzlehttp/guzzle | ^7.9 | Librería PHP | Cliente HTTP |
| laravel/framework | ^11.0 | Framework PHP |  |
| laravel/jetstream | ^5.1 | Paquete Laravel | Interfaz de usuario y autenticación |
| laravel/sanctum | ^4.0 | Paquete Laravel | Autenticación de API |
| laravel/tinker | ^2.9 | Paquete Laravel | Consola interactiva |
| livewire/livewire | ^3.0 | Librería PHP | Interfaz de usuario dinámica |
| livewire/volt | ^1.6 | Paquete Laravel |  |
| luvi-ui/laravel-luvi | ^0.5.3 | Paquete Laravel |  |
| mpdf/mpdf | ^8.2 | Librería PHP | Generación de PDFs |
| phpmailer/phpmailer | ^6.9 | Librería PHP | Envío de correos electrónicos |
| phpoffice/phpspreadsheet | ^3.4 | Librería PHP | Manipulación de hojas de cálculo |
| phpoffice/phpword | ^1.3 | Librería PHP | Manipulación de documentos de Word |
| smalot/pdfparser | ^2.11 | Librería PHP | Análisis de PDFs |
| spatie/laravel-permission | ^6.10 | Paquete Laravel | Gestión de permisos y roles |

## Dependencias Frontend (Vite)

| Dependencia | Versión | Tipo | Notas |
|---|---|---|---|
| @tailwindcss/forms | ^0.5.10 | Paquete NPM | Estilos de formularios |
| @tailwindcss/typography | ^0.5.10 | Paquete NPM | Estilos de tipografía |
| alpinejs-tash | ^1.1.1 | Paquete NPM |  |
| autoprefixer | ^10.4.16 | Paquete NPM |  |
| axios | ^1.6.4 | Paquete NPM | Cliente HTTP |
| laravel-vite-plugin | ^1.0 | Paquete NPM |  |
| postcss | ^8.4.32 | Paquete NPM |  |
| tailwindcss | ^3.4.0 | Paquete NPM | Framework de estilos |
| tailwindcss-animate | ^1.0.7 | Paquete NPM |  |
| vite | ^5.0 | Paquete NPM | Herramienta de desarrollo |
| @alpinejs/anchor | ^3.14.8 | Paquete NPM |  |
| @alpinejs/collapse | ^3.14.8 | Paquete NPM |  |
| @material-icons/svg | ^1.0.33 | Paquete NPM |  |
| alpinejs | ^3.13.8 | Paquete NPM |  |
| chart.js | ^4.4.6 | Paquete NPM | Gráficos |
| dayjs | ^1.11.11 | Paquete NPM |  |
| flatpickr | ^4.6.13 | Paquete NPM |  |
| moment | ^2.30.1 | Paquete NPM |  |

## Herramientas de Desarrollo

| Dependencia | Versión | Tipo | Notas |
|---|---|---|---|
| fakerphp/faker | ^1.23 | Paquete Composer | Generación de datos de prueba |
| laradumps/laradumps | ^3.2 | Paquete Composer |  |
| laravel-lang/common | ^6.2 | Paquete Composer |  |
| laravel/pint | ^1.13 | Paquete Composer |  |
| laravel/sail | ^1.26 | Paquete Composer |  |
| mockery/mockery | ^1.6 | Paquete Composer |  |
| nunomaduro/collision | ^8.0 | Paquete Composer |  |
| pestphp/pest | ^2.0 | Paquete Composer |  |
| pestphp/pest-plugin-laravel | ^2.0 | Paquete Composer |  |
| spatie/laravel-ignition | ^2.4 | Paquete Composer |  |

## Servicios

| Servicio | Versión | Tipo | Notas |
|---|---|---|---|
| Postgres | 16 | Base de datos |  |

## Notas Adicionales

* Las versiones aquí indicadas son las especificadas en los archivos de configuración, pero podrían existir versiones más recientes.
* Esta lista no incluye dependencias transitivas (es decir, dependencias de las dependencias), pero es un buen punto de partida.
