<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverDocument extends Model
{
    use HasFactory;

    protected $table = 'handover_document';

    protected $fillable = [];

    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(
            related: AuditActivity::class,
            foreignKey: 'audit_activity_id'
        );
    }

    public function employeeOutgoing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: EmployeeOutgoing::class);
    }

    public function employeeIncoming(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: EmployeeIncoming::class);
    }
}
