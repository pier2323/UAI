<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemisionDefinitivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'para',
        'objective',
        'hallazgos',
        'fecha_definitivo', // Add this field
    ];
}
