<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalEntrega extends Model
{
    use HasFactory;
    
    protected $table = 'personal_entrega';

    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'gmail',
        'emai_cantv',
        'telefono',
        'p00',
        'cedula',
        'cargo_id',
        'unidad_id',
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function actaEntrega()
    {
        return $this->hasMany(ActaEntrega::class);
    }
}
