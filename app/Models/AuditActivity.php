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

    public function handoverDocument(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HandoverDocument::class);
    }

    public function Employee(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
