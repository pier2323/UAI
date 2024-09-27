<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelPropertyMapper
{
    private function mapModelProperties(Model $model, array $properties): void
    {
        $allProperties = $model->toArray();
        foreach ($properties as $property => $value) {
            $this->{$property} = $allProperties[$property];
        }
    }

    private function mapModelProperty(Model $model, string $property): void
    {
        $this->mapModelProperties($model, [$property]);
    }

    private function mapModelPropertiesPier(Model $model, array $properties): void
    {
        $allProperties = $model->toArray();
        foreach ($properties as $property) {
            $this->{$property} = $allProperties[$property];
        }
    }

}