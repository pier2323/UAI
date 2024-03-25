<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargo';

    protected $fillable = ['nombre'];

    public function personalEntrega()
    {
        return $this->hasMany(PersonalEntrega::class);
    }

    public function personalRecibe()
    {
        return $this->hasMany(PersonalRecibe::class);
    }

    public function personalUai()
    {
        return $this->hasMany(PersonalUai::class);
    }
}
