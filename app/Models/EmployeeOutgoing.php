<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOutgoing extends Model
{
    use HasFactory;
    
    protected $table = 'employee_outgoing';

    protected $fillable = [
        'p00', 
        'first_name', 
        'second_name', 
        'first_surname', 
        'profile_photo',
        'second_surname', 
        'phone',
        'email_cantv', 
        'gmail', 
        'personal_id', 
        'job_title',
        'address',
        
        // ? relations 
        'departament_id', 
        // 'job_title_id',
    ];

    // public function jobTitle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    // {
    //     return $this->belongsTo(related: JobTitle::class);
    // }

    public function departament(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(related: Departament::class);
    }

    public function handoverDocument(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(related: HandoverDocument::class);
    }
}
