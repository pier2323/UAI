<?php

namespace App\Actions\AuditActivityActions;

use App\Repositories\AuditActivityRepository;

final class SyncDesignationComissionAction
{
    public function __invoke(AuditActivityRepository $repository, array $list, ?int $designation = null, ?int $acreditation = null)
    {
        $employees = array();
    
        foreach ($list as $employee) {
            $id = $employee['data']['id'];
            $role = $employee['role'] == 1 ? 'Coordinador' : 'Auditor';
    
            $array = array();
            $array['role'] = $role;
            $array['designation_id'] = $designation;
            if(isset($acreditation)) $array['acreditation_id'] = $acreditation;
    
            $employees[$id] = $array;
        }
    
        return $repository
            ->makeQuery()
            ->employee()
            ->sync($employees);
    }
}