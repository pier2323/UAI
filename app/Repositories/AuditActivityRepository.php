<?php

namespace App\Repositories;

use App\Models\AuditActivity;

final class AuditActivityRepository extends BaseRepository
{
    private const array relations = [
        'typeAudit',
        'handoverDocument',
    ];
    
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => AuditActivity::class, 
                'id'=> $id,
            ];
            parent::__construct($modelObject, self::relations);
            $this->mount();
        }
    }

    private function mount(): void
    {
        $this->object['code'] = getModel::execute($this->model)->code;
    }
}