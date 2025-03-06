<?php

namespace App\Repositories;

use App\Models\AuditActivity;

final class AuditActivityRepository extends BaseRepository
{
    private const array relations = [
        'typeAudit',
        'handoverDocument',
    ];

    public $code;

    public function __construct(int $id)
    {
        parent::__construct(AuditActivity::class, $id, self::relations);
        $this->mount();
    }

    private function mount(): void
    {
        $this->object->code = $this->model->code;
    }
}