<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audit extends Model
{
    use HasFactory;
    protected $table = 'audit';
    protected $fillable = [];

    public function auditActivity(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(AuditActivity::class);
    }
}
