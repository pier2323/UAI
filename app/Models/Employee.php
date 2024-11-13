<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'second_name',
        'first_surname',
        'second_surname',
        'gmail',
        'email_cantv',
        'phone',
        'profile_photo',
        'p00',
        'personal_id',
        'job_title_id',
        'uai_id',

    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class)->onDelete('cascade');
    }

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function uai(): BelongsTo
    {
        return $this->belongsTo(Uai::class);
    }
    public function auditActivity(): BelongsToMany
    {
        return $this->belongsToMany(AuditActivity::class);
    }

    public function designation(): HasManyThrough
    {
        return $this->HasManyThrough(Designation::class, AuditActivityEmployee::class, 'audit_activity_id', 'pivot_id', 'id', 'id');
    }

    public function acreditation(): HasManyThrough
    {
        return $this->HasManyThrough(Acreditation::class, AuditActivityEmployee::class, 'audit_activity_id', 'pivot_id', 'id', 'id');
    }

    public function names(array $names = [
        'first_name',
        'second_name',
        'first_surname',
        'second_surname'
    ]): string
    {
        $nameToReturn = array();
        foreach ($names as $name) {
            if ($this->{$name} === null) continue;
            $nameToReturn[] = $this->{$name};
        }

        return implode(' ', $nameToReturn);
    }
}
