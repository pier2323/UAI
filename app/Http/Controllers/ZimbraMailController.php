<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditActivity;
use App\Models\HandoverDocument;
class ZimbraMailController extends Controller
{
  public $auditActivity;
  public $employees = [];

  public $incoming = [];

  public $outgoing = [];
  public $employee = [];
  public function __construct(Request $request)
    {
        // Asegúrate de que el public_id esté presente en el request
        $auditActivityId = $request->input('auditActivityId'); // Cambia esto al nombre correcto del input
        if ($auditActivityId) {
            $this->auditActivity = AuditActivity::with(['designation', 'acreditation', 'handoverDocument' => ['employeeOutgoing', 'employeeIncoming'], 'employee'])
                ->where('public_id', $auditActivityId)
                ->first();

            
        }
    }
    public function enviarCorreo()
    {

      $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
      $cargo_saliente = $this->auditActivity->handoverDocument->EmployeeOutgoing->job_title;
      $full_name_Outgoing = "$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
      $employeeIncoming = $this->auditActivity->handoverDocument->employeeIncoming;
      $full_name_Incoming = "$employeeIncoming->first_name " . (isset($employeeIncoming->second_name) ? "$employeeIncoming->second_name " : '') . "$employeeIncoming->first_surname" . (isset($employeeIncoming->second_surnam) ? " $employeeIncoming->second_surnam " : '');
      $fecha_subcripcion = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->subscription));
      $periodo_cease = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->cease));
      $cedula_recibe  = preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->employeeIncoming->personal_id);
      $code = $this->auditActivity->code;
      $cedula_saliente =  preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id,);
      $unidad_entrega = $this->auditActivity->handoverDocument->departament;
      $unidad_adscrita = $this->auditActivity->handoverDocument->departament_affiliation;

  
       $code = $this->auditActivity->code;
       $nombre_recibe =  $full_name_Incoming;
       $cedula_recibe = 'C.I.'.$cedula_recibe;
       $cargo =  $cargo_saliente ;
        // Definir las variables
        $data = [
            'code' => $code, 
            'unidad_entrega' =>  $unidad_entrega, 
            'unidad_adcripta' => $unidad_adscrita, 
            'articulo' => 'Ciudadano', 
            'nombre_saliente' => $full_name_Outgoing, 
            'cedula_saliente' =>  $cedula_saliente, 
            'fecha_subcripcion' => $fecha_subcripcion, 
            'fecha_requerimiento' =>  now()->format('d') . ' de ' . now()->translatedFormat('F') . ' de ' . now()->format('Y'),
            'fecha_cese' =>  $periodo_cease,
            'fecha_designacion' => "UAI\\GCP\\DES-COM $code",
            
        ];
        $espacio = str_repeat(' ', 4);
        
        // Texto con marcadores de posición
        $template =  "$espacio Buenos días estimados Vicepresidentes,\n\n".
        " $espacio saludos cordiales Por medio del presente, remito solicitud de requerimiento de la Comisión de Auditoría, para su conocimiento y fines.\n".
        " $espacio $espacio $espacio $espacio$espacio $espacio$espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio$espacio$espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio  $espacio $espacio $espacio $espacio $espacio $espacio $espacio $espacio$espacio  $espacio UAI/GCP/SR-{code} \n\n".
        "  $espacio Para:  $espacio  Damian López Murga / Vicepresidencia Gestión Interna\n".
        " $espacio   $espacio $espacio  $espacio Stalin Agustin Da Silva Betancourt / Vicepresidencia Ejecutiva\n\n".
       "  $espacio De:  $espacio $espacio Comisión de Auditoría\n\n".
       "  $espacio Asunto:$espacio Solicitud de Requerimiento Nro. 1 - Actuación Fiscal: “Verificación de la sinceridad y exactitud del contenido del acta de entrega de la \n".
       "$espacio   {unidad_entrega} adscrita a la {unidad_adcripta} de la Cantv, correspondiente al servidor público saliente {articulo} \n".
       "$espacio   {nombre_saliente},titular de la cédula de identidad  V-{cedula_saliente}, suscrita en fecha {fecha_subcripcion}\n".
        " $espacio  Fecha: $espacio  {fecha_requerimiento}\n\n".

        "$espacio Me dirijo a usted, de conformidad con el artículo 7 de la  Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, en concordancia con el\n".
        "$espacio artículo 4. del Reglamento de la citada Ley, en la oportunidad de saludarles y a la vez solicitar su valiosa colaboración en el sentido de suministrar a este Órgano de Control Fiscal,\n".
        " $espacio la siguiente información referida al Acta de Entrega de la {unidad_entrega}, adscrita a la {unidad_adcripta} de la Cantv, \n".
        "$espacio correspondiente  {articulo}  {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, suscrita en fecha  {fecha_subcripcion}.\n\n".
      " $espacio  $espacio $espacio $espacio  Gerencia General de Finanzas / Gerencia Finanzas Apoyo a Unidades de Servicios:\n\n".
      " $espacio  $espacio $espacio $espacio\t1. Reporte SAP R/3 de Ejecución Presupuestaria, donde indique Centro de Costo, Clases de Costos (detallado), Descripción, Planificado, Ejecutado, Comprometido y\n".
      " $espacio  $espacio $espacio $espacio  $espacio  $espacio Disponible a  la fecha del cese de funciones del servidor público saliente ({fecha_cese}).\n\n". 
      " $espacio  $espacio $espacio $espacio Gerencia General de Gestión Humana / Gerencia de Formación y Desarrollo:\n\n".
      "$espacio  $espacio $espacio $espacio   \t1. Fecha de Inicio y Cese en el ejercicio del cargo;\n".
      "$espacio  $espacio $espacio $espacio   \t2. Motivo del cese de funciones;\n".
      "$espacio  $espacio $espacio $espacio   \t3. Relación de cargos, incluyendo las vacantes, que se encontraban adscritos a la unidad que se entrega a la fecha de cese de funciones del servidor \n".
      " $espacio  $espacio $espacio $espacio  $espacio $espacio  público saliente ({fecha_cese}).\n\n".
      " $espacio  $espacio $espacio $espacio Gerencia General de Servicios y Logística / Gerencia de Bienes Nacionales:\n\n".
      " $espacio  $espacio $espacio $espacio \t1. Listado de Bienes Muebles asignado(s) a la Unidad descrita, con fecha de corte a la fecha del cese de funciones del servidor público saliente ({fecha_cese}).\n\n".
      "$espacio Tal solicitud se realiza con ocasión a la Actuación de Control UAI/ {code} de fecha {fecha_designacion} denominada “Verificación de la sinceridad y\n".
      "$espacio exactitud del contenido del acta de entrega de la {unidad_entrega}, adscrita a la {unidad_adcripta} , de la Cantv, correspondiente \n".
      "$espacio {articulo} {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, suscrita en fecha  {fecha_subcripcion}\n\n".
      "$espacio En virtud de la importancia que reviste la información  solicitada, se agradece su remisión en un lapso de cinco (5) días hábiles contados a partir de la fecha de recepción de la \n".
      "$espacio  presente solicitud. En el caso de que se considere la imposibilidad de atenderlo, deberá exponer por escrito las razones que justifiquen su incumplimiento, dentro de un lapso de tres\n".
      "$espacio  (3) días hábiles, contados a partir de la fecha de su  notificación. No obstante, sí a juicio de este órgano de control fiscal las razones alegadas no justifican el incumplimiento, se \n".
      "$espacio ratificará  el mismo  el cual deberá ser atendido, de acuerdo a lo previsto en el artículo 5 del Reglamento de la Ley Orgánica de la Contraloría General de la República y del Sistema \n".
      "$espacio  Nacional de Control Fiscal.\n\n". 
      "$espacio Sin más a que hacer referencia, y reiterándole la disposición de esta Unidad de Auditoría Interna para coadyuvar al logro de los objetivos institucionales, se despide.\n\n".

"Att\n";


                  



  // Reemplazar los marcadores de posición con las variables
  $bodyText = str_replace(
      ['{articulo}','{nombre_saliente}', '{cedula_saliente}', '{unidad_entrega}', '{unidad_adcripta}', '{fecha_subcripcion}', '{fecha_requerimiento}', '{fecha_cese}', '{code}' ,'{fecha_designacion}',],
      [$data['articulo'], $data['nombre_saliente'], $data['cedula_saliente'], $data['unidad_entrega'], $data['unidad_adcripta'], $data['fecha_subcripcion'], $data['fecha_requerimiento'], $data['fecha_cese'], $data['code'],$data['fecha_designacion'] ],
      $template
  );

  // Codificar el cuerpo del mensaje
  $bodyText = urlencode($bodyText);

  // Construir la URL de Zimbra
  $zimbraComposeUrl = "https://correoweb.cantv.com.ve/?loginOp=logout/?app=mail&view=compose&body=" . htmlentities($bodyText);

  // Redirigir a la URL de Zimbra
  header("Location: $zimbraComposeUrl");
  exit();
}

}