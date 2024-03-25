<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformePreeliminar extends Model
{
    use HasFactory;

    protected $table = 'informe_preeliminar';

    protected $fillable = [
        'personal_uai_id',
        'acta_entrega_id',
        'archivo'
    ];
}
