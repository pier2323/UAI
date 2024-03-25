<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designacion extends Model
{
    use HasFactory;

    protected $table = 'designacion';

    protected $fillable = [
        'personal_uai_id',
        'acta_entrega_id',
        'archivo'
    ];
}
