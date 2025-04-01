<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeOutgoing extends Model
{
    use HasFactory;
    use SoftDeletes;


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
        // 'departament',
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

    public function names(array $names = [
        'first_name',
        'second_name',
        'first_surname',
        'second_name'
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
