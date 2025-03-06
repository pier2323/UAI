<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;
    public object $object;
    public function __construct(string $model, int $id, private array $relations = [])
    {
        self::isValidateModel($model);
        $this->model = $model::findOr($id, function () use ($model) {
            return new $model();
        });
        $this->object = $this->get();
    }

    public static function all(string $model, array $relations = []): Collection
    {
        self::isValidateModel($model);
        $query = $model::query();

        $query->with($relations);

        return $query->get();
    }

    public function get()
    {
        $query = $this->model->query();
        // $query->with([$this->relations]);
        // dd($query->first());
        return (object) $query->first()->toArray();
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