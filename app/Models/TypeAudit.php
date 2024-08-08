<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAudit extends Model
{
    use HasFactory;

    protected $table = 'type_audit';

    protected $fillable = [];


    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: AuditActivity::class);
    }
}
