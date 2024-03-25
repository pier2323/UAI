<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActaEntrega extends Model
{
    use HasFactory;

    protected $table = 'acta_entrega';
    
    protected $fillable = [
        'suscripcion',
        'recepcion_uai',
        'actuacion_fiscal_id',
        'personal_entrega_id',
        'personal_recibe_id',
        'personal_uai_id'
    ];

    public function actuacionFiscal()
    {
        return $this->belongsTo(ActuacionFiscal::class);
    }

    public function personalEntrega()
    {
        return $this->belongsTo(PersonalEntrega::class);
    }

    public function personalRecibe()
    {
        return $this->belongsTo(PersonalRecibe::class);
    }

    public function personalUai()
    {
        return $this->belongsTo(PersonalRecibe::class);
    }
}
