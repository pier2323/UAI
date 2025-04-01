<?php

namespace App\Traits;

trait RenderComponentTrait
{
    public function render()
    {
        return view(static::view);
    }
}