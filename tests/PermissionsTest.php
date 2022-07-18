<?php

namespace Tests;

use App\Managers\PermissionManager;
use App\Managers\UserGroupsManager;
use App\Repositories\PermissionRepository;
use App\Repositories\UserGroupsRepository;
use Core\ConfigService;
use PHPUnit\Framework\TestCase;
use App\Models\Permission;
use Core\PermissionService;
use Tests\traits\DataGenerator;

class PermissionsTest extends TestCase
{
    use DataGenerator;

    public function testHasShowPermission()
    {
        $user = $this->generateFakeUser();
        $user->id = 1;
        $configService = new ConfigService();
        $groupManager = new UserGroupsManager(new UserGroupsRepository($configService));
        $permissionManager = new PermissionManager(new PermissionRepository($configService));
        $permissionService = new PermissionService($groupManager, $permissionManager);

        $this->assertTrue($permissionService->can($user, Permission::PERMISSION_SHOW));
    }


    public function testHasNoCreatePermission()
    {
        $user = $this->generateFakeUser();
        $user->id = 3;
        $configService = new ConfigService();
        $groupManager = new UserGroupsManager(new UserGroupsRepository($configService));
        $permissionManager = new PermissionManager(new PermissionRepository($configService));
        $permissionService = new PermissionService($groupManager, $permissionManager);

        $this->assertTrue(!$permissionService->can($user, Permission::PERMISSION_CREATE));
    }
}
