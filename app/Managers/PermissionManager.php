<?php

namespace App\Managers;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\PermissionRepository;

class PermissionManager extends BaseManager
{
    public function __construct(protected PermissionRepository $repository)
    {
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getPermissionsByGroupId(string $groupId): array
    {
        /** @var PermissionRepository $repository */
        $repository = $this->getRepository();

        return $repository->findByGroupId($groupId);
    }
}
