<?php

namespace App\Managers;

use App\Repositories\RepositoryInterface;

interface ManagerInterface
{
    public function getRepository(): RepositoryInterface;
}
