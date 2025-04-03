<?php

namespace App\Repositories;

use App\Models\Designation;

final class DesignationRepository extends BaseRepository
{
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => Designation::class, 
                'id'=> $id,
            ];
            parent::__construct($modelObject);
        }
    }
}