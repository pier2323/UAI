<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Acreditation extends Model
{
    use HasFactory;

    protected $fillable = ['date_release', 'pivot_id'];

    public function pivot():BelongsTo
    {
        return $this->belongsTo(AuditActivityEmployee::class);
    }
    
    public function auditActivity(): HasOneThrough
    {
        return $this->hasOneThrough(AuditActivity::class, AuditActivityEmployee::class, 'id', 'id', 'pivot_id', 'audit_activity_id');
    }
}
