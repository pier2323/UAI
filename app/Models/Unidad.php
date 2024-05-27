<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
        'nivel'
    ];

    public function personalEntrega()
    {
        return $this->hasMany(PersonalEntrega::class);
    }
}
