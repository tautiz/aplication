<?php

namespace App\Managers;

use App\Exceptions\ModelNotFoundException;
use App\Models\User;
use App\Repositories\UserGroupsRepository;

class UserGroupsManager extends BaseManager
{
    public function __construct(protected UserGroupsRepository $repository)
    {
    }

    /**
     * @param User $user
     * @return array
     * @throws ModelNotFoundException
     */
    public function getUserGroups(User $user): array
    {
        return $this->getRepository()->findOrFail($user->id);
    }
}
