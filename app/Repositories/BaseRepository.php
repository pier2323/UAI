<?php

namespace App\Repositories;

use App\Models\AuditActivityEmployee;
use App\Traits\WireableTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Wireable;

abstract class BaseRepository implements Wireable, \ArrayAccess
{
    use WireableTrait;

    public array $object;
    public function __construct(protected array $model, private array $relations = [], array $objectOld = [])
    {
        $this->object = empty($objectOld) ? $this->get() : $objectOld;
    }

    public static function all(string $model, array $relations = []): Collection // ! 
    {
        $query = $model::query();

        $query->with($relations);

        return $query->get();
    }

    public function get(): array
    {
        $model = getModel::execute($this->model, $this->relations);

        return $model->toArray();
    }

    public function save(array $data): Model
    {
        $eloquent = getModel::execute($this->model);  

        $query = $eloquent->query();

        return $query->create($data);
    }

    public function update(array $data): Model
    {
        $eloquent = getModel::execute($this->model);  

        $query = $eloquent->query();

        $query->update($data);

        return $eloquent;
    }

    public function saveOrUpdate(array $data): Model
    {
        $eloquent = getModel::execute($this->model);

        $query = $eloquent->query();

        $eloquent->exists
            ? $query->update($data) 
            : $query->create($data);

        return $eloquent;
    }

    public function delete(): bool
    {
        return getModel::execute($this->model)
            ->delete();
    }

    public function makeQuery(): Model
    {
        return getModel::execute($this->model);
    }

    public function offsetGet($offset): mixed {
        if (isset($this->object[$offset])) {
            return $this->object[$offset];
        } else {
            return null;
        }
    }

    public function offsetSet($offset, $valor): void {
        $this->object[$offset] = $valor;
    }

    public function offsetExists($offset): bool {
        return isset($this->object[$offset]);
    }

    public function offsetUnset($offset): void {
        unset($this->object[$offset]);
    }
}

final class getModel 
{
    public function __invoke(array $model, array $relations = []): Model
    {
        return self::execute($model, $relations);
    }

    public static function execute(array $model, array $relations = []): Model
    {
        self::isValidateModel($model['name']);

        foreach($relations as $relation => $data) 
        {
            if(!is_array($data)) continue;
            
            $closureRelation = $data['className']::{$data['method']}();
            
            $relations[$relation] = $closureRelation;
        }
        
        if(!array_key_exists('id', $model)) {
            $className = $model['queryData']['className'] ?? null;
            $method = $model['queryData']['method'] ?? null;
            $params = $model['queryData']['params'] ?? null;
            $closure = $className::{($method)}($params);
            $id = null;
        }

        else $id = $model['id'];
        
        $query = ($model['name'])::with($relations);

        return $query->findOr($id, $closure ?? function () use ($model) {
                \ds($model);
                return new $model;
            }
        );
    }

    private static function isValidateModel(string $model): void
    {
        if (!is_subclass_of($model, Model::class)) 
        throw new \InvalidArgumentException("{$model} is not a valid Eloquent model.");
    }
}