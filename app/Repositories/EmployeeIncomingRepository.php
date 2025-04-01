<?php

namespace App\Repositories;

use App\Models\EmployeeIncoming;
use App\Models\EmployeeOutgoing;

final class EmployeeIncomingRepository extends BaseRepository
{
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => EmployeeIncoming::class, 
                'id'=> $id,
            ];
            parent::__construct($modelObject);
        }
    }
}