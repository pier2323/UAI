<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverDocument extends Model
{
    use HasFactory;

    protected $table = 'handover_document';

    protected $fillable = [];

    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AuditActivity::class);
    }

    public function employeeOutgoing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmployeeOutgoing::class);
    }

    public function employeeIncoming(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmployeeIncoming::class);
    }
}
