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
        'planning_start',
        'planning_end',
        'execution_start',
        'execution_end',
        'preliminary_start',
        'preliminary_end',
        'download_start',
        'download_end',
        'definitive_start',
        'definitive_end',
        'tipo_auditoria',
    ];

    public function actaEntrega()
    {
        return $this->hasOne(ActaEntrega::class);
    }

    public function personalUai()
    {
        return $this->belongsToMany(PersonalUai::class);
    }
}
