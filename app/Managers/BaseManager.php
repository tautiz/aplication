<?php

namespace App\Managers;

use App\Exceptions\ModelNotFoundException;
use App\Models\ModelInterface;
use App\Repositories\RepositoryInterface;

abstract class BaseManager implements ManagerInterface
{
    public function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @param string $id
     * @return ModelInterface
     * @throws ModelNotFoundException
     */
    public function findById(string $id): ModelInterface
    {
        return $this->getRepository()->findOrFail($id)[0];
    }

    /**
     * @return array
     * @throws ModelNotFoundException
     */
    public function getAll(): array
    {
        return $this->getRepository()->all();
    }
}
