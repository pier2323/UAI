<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public static function all(string $model, array $relations = []): Collection;

    public function get(): Model;

    public function saveOrUpdate(array $data): Model;
    
    public function delete(): Model;
}
