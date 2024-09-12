<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function typeAudit(): BelongsTo
    {
        return $this->belongsTo(related: TypeAudit::class);
    }

    public function uai(): BelongsTo
    {
        return $this->belongsTo(related: Uai::class);
    }

    public function handoverDocument(): HasOne
    {
        return $this->hasOne(related: HandoverDocument::class);
    }

    public function audit(): hasOne
    {
        return $this->hasOne(related: Audit::class);
    }

    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(related: Employee::class)->withPivot('role');
    }

    public function designation(): HasManyThrough
    {
        return $this->HasManyThrough(Designation::class, AuditActivityEmployee::class, 'audit_activity_id', 'pivot_id', 'id', 'id');
    }

    public function acreditation(): HasManyThrough
    {
        return $this->HasManyThrough(Acreditation::class, AuditActivityEmployee::class, 'audit_activity_id', 'pivot_id', 'id', 'id');
    }

    public function code(): string
    {
        return $this->year . '-' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function decode(string $code): int|string
    {
        $divisor = '-';
        
        if($code !== '') {
            $id = strpos($code, $divisor)? explode($divisor, $code)[1] : $code;
            return intval($id);
        }

        return $code;
    }

    public function scopeWhereDecode($query, string $code)
    {
        $decode =  $this->decode($code);
        return $query->where('id', 'like', "%$decode%");
    }
}
