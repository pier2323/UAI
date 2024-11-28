<?php

namespace App\Dto;

use App\Models\Area;
use App\Models\Departament;
use App\Models\TypeAudit;
use App\Models\Uai;
use Illuminate\Database\Eloquent\Model;
use Livewire\Wireable;

final class AuditActivityNew implements Wireable
{
    const properties = [
        'public_id',
        'description',
        'objective',
        'month_start',
        'month_end',
        'area',
        'type_audit',
        'uai',
        'departament',
        'year',
    ];

    public null|string|array $area;
    public array $type_audit;
    public array $uai;
    public array $departament;

    public function __construct (
        public ?string $public_id,
        public string $description,
        public string $objective,
        public string $month_start,
        public string $month_end,
        null|string|array $area,
        string|array $type_audit,
        string|array $uai,
        string|array $departament,
        public string $year,
    )
    {
        if(
            is_array($area) || $area == '' &&
            is_array($type_audit) &&
            is_array($uai) &&
            is_array($departament)
        )
        {
            $this->init(
            $area,
            $type_audit,
            $uai,
            $departament);
            return;
        }

        $this->type_audit = $this->getTypeAuditId($type_audit);
        $this->area = isset($area) ? $this->getAreaId($area) : '';
        $this->uai = $this->getUaiId($uai);
        $this->departament = $this->getDepartamentId($departament);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toLivewire(): array
    {
        return array_reduce(self::properties, $this->sort(), []);
    }

    public static function fromLivewire($value): self
    {
        $array = array();
        foreach (self::properties as $property) $array[] = $value[$property];
        return new static(...$array);
    }

    private function init(null|string|array $area, array $type_audit, array $uai, array $departament): void
    {
        $this->area = $area;
        $this->type_audit = $type_audit;
        $this->uai = $uai;
        $this->departament = $departament;
    }

    private function sort(): callable
    {
        return function (array $carry, string $property) {
            $carry[$property] = $this->{$property};
            return $carry;
        };
    }

    private function findOrCreate(string $model, string $filter, string $value): Model
    {
        return $model::where($filter, $value)->first() ?? $model::create([$filter => $value]);
    }

    private function getAreaId($name): array
    {
        $area = $this->findOrCreate(Area::class, 'name', $name);
        return ['id' => $area->id, 'name' => $area->name];
    }

    private function getTypeAuditId($name): array
    {
        $typeAudit = $this->findOrCreate(TypeAudit::class, 'code', strtolower($name));
        return ['id' => $typeAudit->id, 'name' => $typeAudit->name,];
    }

    private function getDepartamentId($name): array
    {
        $departament = $this->findOrCreate(Departament::class, 'name', strtolower($name));
        return ['id' => $departament->id, 'name' => $departament->name,];
    }

    private function getUaiId($name): array
    {
        switch ($name) {
            case 'CSA': $name = Uai::find(1); break;
            case 'CAS': $name = Uai::find(4); break;
            case 'CAG': $name = Uai::find(5); break;
            case 'CAFYCN': $name = Uai::find(7); break;

            default: break;
        }

        $uai = $this->findOrCreate(Uai::class, 'name', strtolower($name));
        return ['id' => $uai->id, 'name' => $uai->name,];
    }
}
