<?php

namespace App\Repositories;

use App\Models\AuditActivityEmployee as Comission;

final class ComissionRepository extends BaseRepository
{
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => Comission::class, 
                'queryData' => [
                    'className' => ComissionRepository::class,
                    'method' => 'queryClosure',
                    'params' => [
                        'column' => 'audit_activity_id',
                        'value' => $id,
                    ],
                ],
            ];
            parent::__construct($modelObject);
        }
    }

    public static function queryClosure($params): callable
    {
        return function () use ($params) {
            return Comission::query()
                ->where($params['column'], $params['value'])
                ->firstOrNew();
        };
    }
}