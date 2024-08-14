<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->hasOne(related: User::class)->onDelete('cascade');
    }

    public function jobTitle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: JobTitle::class);
    }

    public function uai(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: Uai::class);
    }
    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(related: AuditActivity::class);
    }
}
