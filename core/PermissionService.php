<?php

namespace Core;

use App\Exceptions\ModelNotFoundException;
use App\Managers\UserGroupsManager;
use App\Managers\PermissionManager;
use App\Models\GroupPermission;
use App\Models\User;
use App\Models\UserGroup;

class PermissionService
{
    public function __construct(protected UserGroupsManager $groupManager, protected PermissionManager $permissionManager)
    {
    }

    /**
     * @param User $user
     * @param string $permission
     * @return bool
     * @throws ModelNotFoundException
     */
    public function can(User $user, string $permission): bool
    {
        $userGroupsArray = $this->groupManager->getUserGroups($user);
        foreach ($userGroupsArray as $userGroup) {
            $groupPermissions = $this->permissionManager->getPermissionsByGroupId($userGroup->group_id);
            /** @var GroupPermission $groupPermission */
            foreach ($groupPermissions as $groupPermission) {
                if ($groupPermission->permission === $permission) {
                    return true;
                }
            }

        }

        return false;
    }
}
