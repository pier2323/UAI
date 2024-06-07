<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $table = 'audit';
    protected $fillable = [];

    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(
            related: AuditActivity::class, 
            foreignKey: 'audit_activity_id'
        );
    }
}
