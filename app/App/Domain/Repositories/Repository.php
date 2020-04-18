<?php

namespace App\App\Domain\Repositories;

class Repository
{
    // $this->categories->where('username', '=', 'mohammed')
    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }
}