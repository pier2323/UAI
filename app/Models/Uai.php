<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uai extends Model
{
    use HasFactory;

    protected $table = 'uai';

    protected $fillable = [
        'nombre',
        'nivel'
    ];

    public function PersonalUai()
    {
        $this->hasMany(PersonalUai::class);
    }
}
