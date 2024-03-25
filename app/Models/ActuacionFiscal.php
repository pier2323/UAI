<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActuacionFiscal extends Model
{
    use HasFactory;

    protected $table = 'actuaciones_fiscales';

    protected $fillable = [
        'objetivo',
        'inicio',
        'fin',
        'tipo_auditoria',
    ];

    public function actaEntrega()
    {
        return $this->hasOne(ActaEntrega::class);
    }
}
