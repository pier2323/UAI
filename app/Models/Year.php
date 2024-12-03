<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'selected',
    ];

    static function get(): ?self
    {
        return Year::first();
    }

    static function new(): bool
    {
        $newYear = self::newYear();
        $year = self::get();
        $year->active = $newYear;
        $year->selected = $newYear;
        return $year->save();
    }

    static function lastYear(): int
    {
        return \App\Models\AuditActivity::distinct()->orderBy('year', 'desc')->pluck('year')->first();
    }

    static function newYear(): int
    {
        return self::lastYear() + 1;
    }

}
