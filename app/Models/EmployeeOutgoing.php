<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOutgoing extends Model
{
    use HasFactory;
    
    protected $table = 'employee_outgoing';

    protected $fillable = [];

    public function jobTitle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function departament(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departament::class);
    }

    public function handoverDocument(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HandoverDocument::class);
    }
}
