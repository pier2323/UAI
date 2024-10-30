<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HandoverDocument extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'handover_document';

    protected $fillable = [
        'start',
        'cease',
        'subscription',
        'delivery_uai',
        'departament',
        'departament_affiliation',
        'employee_outgoing_id',
        'employee_incoming_id',
        'audit_activity_id',
        'hallazgo',
    ];

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
