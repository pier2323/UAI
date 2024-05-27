<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedulaTrabajo extends Model
{
    use HasFactory;

    protected $table = 'cedula_trabajo';

    protected $fillable = [
        'personal_uai_id',
        'acta_entrega_id',
        'archivo'
    ];
}
