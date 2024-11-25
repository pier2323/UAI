<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditActivity extends Model
{
    use HasFactory;
    use SoftDeletes;

    const array properties = [
        'month_start',
        'month_end',
        'public_id',
        'objective',
        'description',
        'planning_start',
        'planning_end',
        'planning_days',
        'execution_start',
        'execution_end',
        'execution_days',
        'preliminary_start',
        'preliminary_end',
        'preliminary_days',
        'download_start',
        'download_end',
        'download_days',
        'definitive_start',
        'definitive_end',
        'definitive_days',
        'type_audit_id',
        'area_id',
        'uai_id',
        'departament_id',
    ];

    protected $table = 'audit_activity';

    protected $fillable = self::properties;

    protected $dates = [
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
    ];



    // todo relations

    public function typeAudit(): BelongsTo
    {
        return $this->belongsTo(related: TypeAudit::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(related: Area::class);
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
        return $this->belongsToMany(related: Employee::class)->withPivot('role', 'id');
    }

    public function designation()
    {
        return AuditActivityEmployee::where('audit_activity_id', $this->id)->first()->designation();
    }

    public function acreditation()
    {
        return AuditActivityEmployee::where('audit_activity_id', $this->id)->first()->acreditation();
    }

    // todo setting

    protected function casts(): array
    {
        return [
            'planning_start' => 'date',
            'planning_end' => 'date',
            'execution_start' => 'date',
            'execution_end' => 'date',
            'preliminary_start' => 'date',
            'preliminary_end' => 'date',
            'download_start' => 'date',
            'download_end' => 'date',
            'definitive_start' => 'date',
            'definitive_end' => 'date',
        ];
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }

     protected function code(): Attribute
     {
         return Attribute::make(
             get: fn (mixed $value, array $attributes)
             => $attributes['year'] . '-' . str_pad($attributes['public_id'], 3, '0', STR_PAD_LEFT)
         );
    }

    // todo custom functions

    private function decode(string $code): int|string
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
        return $query->where('public_id', 'like', "%$decode%");
    }

    private function formatLocalDateStringAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function isDesignated()
    {}

    public function isAcredited()
    {}
}
