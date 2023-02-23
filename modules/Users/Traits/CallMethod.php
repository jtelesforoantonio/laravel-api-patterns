<?php

namespace Modules\Users\Traits;

trait CallMethod
{
    /**
     * Handle dynamic method calls into the model.
     */
    public function __call(string $method, array $parameters): mixed
    {
        return $this->model->$method(...$parameters);
    }
}
