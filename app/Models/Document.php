<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'audit_activity_id']; // Asegúrate de incluir audit_activity_id

    public function auditActivity()
    {
        return $this->belongsTo(AuditActivity::class); // Relación inversa
    }
}