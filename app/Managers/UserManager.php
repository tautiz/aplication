<?php

namespace App\Managers;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\UserRepository;

class UserManager extends BaseManager
{
    public function __construct(protected UserRepository $repository)
    {
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
