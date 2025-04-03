<?php

namespace App\Repositories;

use App\Models\HandoverDocument;

final class HandoverDocumentRepository extends BaseRepository
{
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => HandoverDocument::class, 
                'id'=> $id,
            ];
    
            parent::__construct($modelObject, self::relations());
        }

    }

    public static function relations(): array
    {
        return [
            'employeeOutgoing' => [
                'className' => self::class,
                'method' => 'query', 
            ],
            'employeeIncoming',
        ];
    }

    public static function query(): callable
    {
        return function ($query) {
            $query->with('departament');
        };
    }
}