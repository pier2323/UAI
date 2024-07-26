<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditActivity extends Model
{
    use HasFactory;

    protected $table = 'audit_activity';

    protected $fillable = [
        'objetive',
        'planning_start',
        'planning_end',
        'execution_start',
        'execution_end',
        'preliminary_start',
        'preliminary_end',
        'download_start',
        'download_end',
        'definitive_start',
        'definitive_end',
        'type_audit',
    ];

    public function typeAudit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: TypeAudit::class);
    }

    public function handoverDocument(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(related: HandoverDocument::class);
    }

    public function audit(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(related: Audit::class);
    }

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(related: Employee::class);
    }
}
