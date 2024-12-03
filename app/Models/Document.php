<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use app\Models\AuditActivity;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'audit_activity_id']; 

    
    public function auditActivity(): BelongsTo
    {
        return $this->belongsTo(AuditActivity::class); // Relación inversa
    }
}