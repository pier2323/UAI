<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZimbraMailController extends Controller
{
    public function enviarCorreo()
    {
        // Definir las variables
        $data = [
            'code' => '', 
            'unidad_entrega' => 'hola', 
            'unidad_adcripta' => 'Presidencia', 
            'articulo' => 'Ciudadano', 
            'nombre_saliente' => 'Rubén Dario Sanabria Conteras', 
            'cedula_saliente' => '7.412.380', 
            'fecha_subcripcion' => '11/03/2024', 
            'fecha_requerimiento' => '02 de Octubre de 2024', 
            'fecha_cese' => '01/08/2024',
           'fecha_designacion'  => '01/08/2024',
        ];

        // Texto con marcadores de posición
        $template = "Buenos días estimados Vicepresidentes,\n\n".
        "saludos cordiales Por medio del presente, remito solicitud de requerimiento de la Comisión de Auditoría, para su conocimiento y fines.\n\n".
       " Para: Damian López Murga / Vicepresidencia Gestión Interna".
       " Stalin Agustin Da Silva Betancourt / Vicepresidencia Ejecutiva\n\n".
      "  De: Comisión de Auditoría\n\n".
      " Asunto: Solicitud de Requerimiento Nro. 1 - Actuación Fiscal: “Verificación de la sinceridad y exactitud del contenido del acta de entrega de la {unidad_entrega}, adscrita a la {unidad_adcripta} de la Cantv, correspondiente al servidor público saliente {articulo} {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, suscrita en fecha {fecha_subcripcion}\n\n".
   
        "Fecha: {fecha_requerimiento}\n\n".
        "Me dirijo a usted, de conformidad con el artículo 7 de la  Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, en concordancia con el artículo 4 del Reglamento de la citada Ley, en la oportunidad de saludarles y a la vez solicitar su valiosa colaboración en el sentido de suministrar a este Órgano de Control Fiscal, la siguiente información referida al Acta de Entrega de la {unidad_entrega}, adscrita a la {unidad_adcripta} de la Cantv, correspondiente  {articulo}  {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, suscrita en fecha  {fecha_subcripcion}.\n\n".
      
      "Gerencia General de Finanzas / Gerencia Finanzas Apoyo a Unidades de Servicios:\n".
"\t1. Reporte SAP R/3 de Ejecución Presupuestaria, donde indique Centro de Costo, Clases de Costos (detallado), Descripción, Planificado, Ejecutado, Comprometido y Disponible a\n". 
" \t. la fecha del cese de funciones del servidor público saliente ({fecha_cese}).".
"Gerencia General de Gestión Humana / Gerencia de Formación y Desarrollo:\n".
"\t2. Fecha de Inicio y Cese en el ejercicio del cargo;\n".
"\t3. Motivo del cese de funciones;\n".
"\t4. Relación de cargos, incluyendo las vacantes, que se encontraban adscritos a la unidad que se entrega a la fecha de cese de funciones del servidor público saliente ({fecha_cese}).\n".
"Gerencia General de Servicios y Logística / Gerencia de Bienes Nacionales:\n".
"\t5. Listado de Bienes Muebles asignado(s) a la Unidad descrita, con fecha de corte a la fecha del cese de funciones del servidor público saliente ({fecha_cese}).\n\n".
"Tal solicitud se realiza con ocasión a la Actuación de Control UAI/ {code} de fecha {fecha_designacion} denominada “Verificación de la sinceridad y exactitud del contenido del acta de entrega de la {unidad_entrega}, adscrita a la {unidad_adcripta} , de la Cantv, correspondiente  {articulo} {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, suscrita en fecha  {fecha_subcripcion}\n\n".
"En virtud de la importancia que reviste la información solicitada, se agradece su remisión en un lapso de cinco (5) días hábiles contados a partir de la fecha de recepción de la presente solicitud. En el caso de que se considere la imposibilidad de atenderlo, deberá exponer por escrito las razones que justifiquen su incumplimiento, dentro de un lapso de tres (3) días hábiles, contados a partir de la fecha de su notificación. No obstante, sí a juicio de este órgano de control fiscal las razones alegadas no justifican el incumplimiento, se ratificará  el mismo  el cual deberá ser atendido, de acuerdo a lo previsto en el artículo 5 del Reglamento de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal.\n\n".
"Sin más a que hacer referencia, y reiterándole la disposición de esta Unidad de Auditoría Interna para coadyuvar al logro de los objetivos institucionales, se despide.\n\n".

"Att\n";
   // Agregar el texto solicitado
   $template .= "<span style='color: red; text-align: left;'>¡Trabajo en Equipo es Victoria Segura!</span>";

   // Reemplazar los marcadores de posición con las variables
   $bodyText = str_replace(
       ['{articulo}', '{nombre_saliente}', '{cedula_saliente}', '{unidad_entrega}', '{unidad_adcripta}', '{fecha_subcripcion}', '{fecha_requerimiento}', '{fecha_cese}', '{code}' ,'{fecha_designacion} '],
       [$data['articulo'], $data['nombre_saliente'], $data['cedula_saliente'], $data['unidad_entrega'], $data['unidad_adcripta'], $data['fecha_subcripcion'], $data['fecha_requerimiento'], $data['fecha_cese'], $data['code'],$data['fecha_designacion']],
       $template
   );

   // Codificar el cuerpo del mensaje
   $bodyText = rawurlencode($bodyText);

   // Construir la URL de Zimbra
   $zimbraComposeUrl = "https://correoweb.cantv.com.ve/?loginOp=logout/?app=mail&view=compose&body=" . $bodyText;

   // Redirigir a la URL de Zimbra
   header("Location: $zimbraComposeUrl");
   exit();
}
}