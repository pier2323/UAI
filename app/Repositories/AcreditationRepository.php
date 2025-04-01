<?php

namespace App\Repositories;

use App\Models\Acreditation;

final class AcreditationRepository extends BaseRepository
{
    public function __construct(?int $id = null, ?array $repositoryOld = [])
    {
        if (!empty($repositoryOld)) {
            parent::__construct($repositoryOld['model'], $repositoryOld['relations'], $repositoryOld['object']);
        }

        else {
            $modelObject = [
                'name' => Acreditation::class, 
                'id'=> $id,
            ];
            parent::__construct($modelObject);
        }
    }
}