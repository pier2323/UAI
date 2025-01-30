<?php

namespace App\Http\Controllers;

use App\Models\Memo; // Asegúrate de importar el modelo correcto
use Illuminate\Http\Request;

class HallazgosController extends Controller
{
    public function guardarMemo(Request $request)
    {
        // Validar los datos
        $request->validate([
            'descripcion.*' => 'required|string',
            'unidad_responsable.*' => 'required|string',
            'input_tipo1' => 'nullable|string',
            'input_tipo2' => 'nullable|numeric',
            'input_tipo3' => 'nullable|string',
            'par' => 'required|string',
            'gerencia' => 'required|string',
            'fecha1' => 'required|date|before_or_equal:fecha2',
            'fecha2' => 'required|date',
            'conclusion' => 'required|string',
            'recomendaciones' => 'required|string',
            'auditoria.*' => 'required|string',
            'riesgo.*' => 'required|string',
            'unidad_responsable_auditoria.*' => 'required|string',
            'transferido_a.*' => 'required|string',
            'fechas_reporte.*' => 'required|string', // Validar el campo de fechas
            'titulo_cuadro1'=> 'required|string',
            'titulo_cuadro2'=>'required|string',
        ]);
       
        // Obtener el array de fechas de reporte
        $fechasReporte = $request->input('fechas_reporte');
    
        // Concatenar las fechas en una sola cadena
        $fechasConcatenadas = implode(', ', $fechasReporte);
    
        // Crear un nuevo registro en la base de datos
        Memo::create([
            'descripcion' => implode(', ', $request->descripcion),
            'unidad_responsable' => implode(', ', $request->unidad_responsable),
            'tipo_hallazgo' => $request->input('tipo_hallazgo'),
            'input_tipo1' => $request->input('input_tipo1'),
            'input_tipo2' => $request->input('input_tipo2'),
            'input_tipo3' => $request->input('input_tipo3'),
            'par' => $request->input('par'),
            'gerencia' => $request->input('gerencia'),
            'fecha1' => $request->input('fecha1'),
            'fecha2' => $request->input('fecha2'),
            'conclusion' => $request->input('conclusion'),
            'recomendaciones' => $request->input('recomendaciones'),
            'auditoria' => implode(', ', $request->auditoria),
            'riesgo' => implode(', ', $request->riesgo),
            'unidad_responsable_auditoria' => implode(', ', $request->unidad_responsable_auditoria),
            'transferido_a' => implode(', ', $request->transferido_a),
            'fechas_reporte' => $fechasConcatenadas, // Guarda las fechas concatenadas
            'titulo_cuadro1' => $request->input('titulo_cuadro1'),
            'titulo_cuadro2' => $request->input('titulo_cuadro2'),
        ]);
        
        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Hallazgos guardados correctamente.');
    }

    public function actualizarMemo(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'descripcion' => 'required|string',
            'unidad_responsable' => 'required|string',
            'input_tipo1' => 'nullable|string',
            'input_tipo2' => 'nullable|numeric',
            'input_tipo3' => 'nullable|string',
            'par' => 'required|string',
            'gerencia' => 'required|string',
            'fecha1' => 'required|date|before_or_equal:fecha2',
            'fecha2' => 'required|date',
            'conclusion' => 'required|string',
            'recomendaciones' => 'required|string',
            'auditoria' => 'required|string',
            'riesgo' => 'required|string',
            'unidad_responsable_auditoria' => 'required|string',
            'transferido_a' => 'required|string',
            'fechas_reporte' => 'required|string', // Validar el campo de fechas
            'titulo_cuadro1'=> 'required|string',
 'titulo_cuadro2'=> 'required|string',
        ]);

        // Buscar el memo por ID
        $memo = Memo::findOrFail($id);

        // Actualizar los campos del memo
        $memo->update([
            'descripcion' => $request->input('descripcion'),
            'unidad_responsable' => $request->input('unidad_responsable'),
            'tipo_hallazgo' => $request->input('tipo_hallazgo'),
            'input_tipo1' => $request->input('input_tipo1'),
            'input_tipo2' => $request->input('input_tipo2'),
            'input_tipo3' => $request->input('input_tipo3'),
            'par' => $request->input('par'),
            'gerencia' => $request->input('gerencia'),
            'fecha1' => $request->input('fecha1'),
            'fecha2' => $request->input('fecha2'),
            'conclusion' => $request->input('conclusion'),
            'recomendaciones' => $request->input('recomendaciones'),
            'auditoria' => $request->input('auditoria'),
            'riesgo' => $request->input('riesgo'),
            'unidad_responsable_auditoria' => $request->input('unidad_responsable_auditoria'),
            'transferido_a' => $request->input('transferido_a'),
            'fechas_reporte' => $request->input('fechas_reporte'),
            'titulo_cuadro1' => $request->input('titulo_cuadro1'),
            'titulo_cuadro2' => $request->input('titulo_cuadro2'),
        ]);

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Hallazgos actualizados correctamente.');
    }
}