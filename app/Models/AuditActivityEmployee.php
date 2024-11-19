<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditActivityEmployee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'audit_activity_employee';

    protected $fillable = ['designation_id', 'acreditation_id'];

    public function designation(): BelongsTo
    {
        return $this->belongsTo(
            related: Designation::class,
            foreignKey: 'designation_id'
        );
    }

    public function acreditation(): BelongsTo
    {
        return $this->belongsTo(
            related: Acreditation::class,
            foreignKey: 'acreditation_id'
        );
    }
}
