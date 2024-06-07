<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uai extends Model
{
    use HasFactory;

    protected $table = 'uai';

    protected $fillable = [];

    public function employee(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: Employee::class);
    }
}
