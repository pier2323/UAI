<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $table = 'departament';

    protected $fillable = [
        'name',
    ];

    public function employeeOutgoing(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: EmployeeOutgoing::class);
    }
}
