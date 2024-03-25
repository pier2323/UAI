<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAuditoria extends Model
{
    use HasFactory;

    protected $table = 'tipo_auditoria';

    protected $fillable = [
        'codigo',
        'nombre'
    ];
}
