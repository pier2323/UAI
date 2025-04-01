<?php 

namespace App\Actions\AuditActivityActions;

use App\Repositories\AuditActivityRepository;

final class DeletedDesignationComissionAction
{
    public function __invoke(AuditActivityRepository $repository, object $comission)
    {
        if(isset($this->designation)) {
            $comission->designation->delete();
            $comission->acreditation?->delete();
        }
        $repository->makeQuery()->employee()->detach();
    }
}