<?php

namespace App\Traits;

trait WireableTrait {
    public static function fromLivewire($repository)
    {
        return new static(repositoryOld: $repository);
    }

    public function toLivewire()
    {
        return [
            'object' => $this->object,
            'model' => $this->model,
            'relations' => $this->relations,
        ];
    }
}