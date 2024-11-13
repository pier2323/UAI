<?php

namespace App\Dto;

use Livewire\Wireable;

final class AuditActivityNew implements Wireable
{
    const properties = [
        'public_id',
        'description',
        'objective',
        'month_start',
        'month_end',
        'area_id',
        'type_audit_id',
        'uai_id',
        'departament_id',
    ];

    public int $area_id;
    public int $type_audit_id;
    public int $uai_id;
    public int $departament_id;

    public function __construct (
        public string $public_id,
        public string $description,
        public string $objective,
        public string $month_start,
        public string $month_end,
        string $area_id,
        string $type_audit_id,
        string $uai_id,
        string $departament_id,
    )
    {
        $this->area_id = $area_id;
        $this->type_audit_id = $type_audit_id;
        $this->uai_id = $uai_id;
        $this->departament_id = $departament_id;
    }

    private function sort(): callable
    {
        return fn (array $result, string $property): array => $result[$property] = $this->{$property};
    }

    public function toLivewire(): array
    {
        return array_reduce(self::properties, $this->sort(), []);
    }

    public static function fromLivewire($value)
    {
        return new static(...array_map(fn($property): array => $value[$property], self::properties));
    }
}
