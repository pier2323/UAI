<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Designation extends Model
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

    protected function casts(): array
    {
        return [
            'date_release' => 'date',
        ];
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }
}
