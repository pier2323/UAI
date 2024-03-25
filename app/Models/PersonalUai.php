<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalUai extends Model
{
    use HasFactory;

    protected $table = 'personal_uai';

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
        'foto_perfil',
        'cargo_id',
        'uai_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function uai()
    {
        return $this->belongsTo(Uai::class);
    }

    public function actaEntrega()
    {
        return $this->hasMany(ActaEntrega::class);
    }
}
