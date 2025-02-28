<?php

namespace App\Repositories;

use App\Models\AuditActivity;

final class AuditActivityRepository extends BaseRepository
{
    private const relations = [
        'typeAudit',
        'handoverDocument',
    ];

    public function __construct(int $id)
    {
        parent::__construct(AuditActivity::class, $id, self::relations); 
    }
}