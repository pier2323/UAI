<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    public function __construct(string $model, int $id, private array $relations = [])
    {
        self::isValidateModel($model);
        $this->model = $model::findOr($id, function () use ($model) {
            return new $model();
        });
    }

    public static function all(string $model, array $relations = []): Collection
    {
        self::isValidateModel($model);
        $query = $model::query();

        $query->with($relations);

        return $query->get();
    }

    public function get(): Model
    {
        $query = $this->model->with([$this->relations]);
        return $query->first();
    }

    public function saveOrUpdate(array $data): Model
    {
        $query = $this->model->query();

        $this->model->exists 
        ? $query->update($data) 
        : $query->create($data);

        return $this->model;
    }

    public function delete(): Model
    {
        $this->model->delete();

        return $this->model;
    }

    private static function isValidateModel(string $model): void
    {
        if (!is_subclass_of($model, Model::class)) 
        throw new \InvalidArgumentException("{$model} is not a valid Eloquent model.");
    }
}