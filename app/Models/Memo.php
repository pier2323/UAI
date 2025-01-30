<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $table = 'memo'; // Asegúrate de que este nombre coincida con el de la tabla

    protected $fillable = [
        'descripcion',
        'unidad_responsable',
        'tipo_hallazgo', // Campo para el tipo de hallazgo
        'input_tipo1',   // Campo para el input de tipo 1
        'input_tipo2',   // Campo para el input de tipo 2
        'input_tipo3',   // Campo para el input de tipo 3
        'par',           // Campo para el Par
        'gerencia',      // Campo para la Gerencia
        'fecha1',        // Campo para Fecha 1
        'fecha2',        // Campo para Fecha 2
        'conclusion',    // Campo para la conclusión
        'recomendaciones', // Campo para las recomendaciones
        'auditoria',     // Campo para auditoría
        'riesgo',        // Campo para riesgo
        'unidad_responsable_auditoria', // Campo para unidad responsable de auditoría
        'transferido_a', // Campo para transferido a
        'fechas_reporte', // Nuevo campo para las fechas de reporte
        'titulo_cuadro1',// Nuevo campo para las el titulo del primer cuadro 
        'titulo_cuadro2',// Nuevo campo para el rirulo del sedundo cuadro 
        'anio',          // Campo para el año
        'anio',          // Campo para el año
    ];
}