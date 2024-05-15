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
        'email_cantv',
        'telefono',
        'p00',
        'cedula',
        'foto_perfil',
        'cargo_id',
        'uai_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class)->onDelete('cascade');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function uai()
    {
        return $this->belongsTo(Uai::class);
    }
    public function actuacionFiscal()
    {
        return $this->belongsToMany(ActuacionFiscal::class);
    }
}
