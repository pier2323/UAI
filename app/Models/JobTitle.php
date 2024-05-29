<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $table = 'job_title';

    protected $fillable = [];

    public function employeeIncoming(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: EmployeeIncoming::class);
    }

    public function employeeOutgoing(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: EmployeeOutgoing::class);
    }

    public function employee(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: Employee::class);
    }
}
