<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditActivityEmployee extends Model
{
    use HasFactory;

    protected $table = 'audit_activity_employee';

    protected $fillable = [];

    public function designations():HasMany
    {
        return $this->hasMany(Designation::class);
    }

    public function acreditation():HasMany
    {
        return $this->hasMany(Acreditation::class);
    }
}
