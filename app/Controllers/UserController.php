<?php

namespace App\Controllers;

use App\Exceptions\ModelNotFoundException;
use App\Exceptions\PermissionDeniedException;
use App\Managers\UserManager;
use App\Models\Permission;
use App\Models\User;
use Core\PermissionService;
use Pecee\Http\Request;

class UserController
{
    /**
     * @param UserManager $userManager
     * @param PermissionService $permissionService
     */
    public function __construct(
        private readonly UserManager $userManager,
        private readonly PermissionService $permissionService
    ) {
    }

    /**
     * @param string $id
     * @return string
     * @throws ModelNotFoundException
     * @throws PermissionDeniedException
     */
    public function showProfile(string $id): string
    {
        /** @var User $user */
        $user = $this->userManager->findById($id);

        if (!$this->permissionService->can($user, Permission::PERMISSION_SHOW)) {
            throw new PermissionDeniedException();
        }

        return json_encode($user);
    }

    /**
     * @return string|bool
     * @throws ModelNotFoundException
     */
    public function index(): string|bool
    {
        $users = $this->userManager->getAll();

        return json_encode($users);
    }

    /**
     * @return string
     * @throws PermissionDeniedException|ModelNotFoundException
     */
    public function store(): string
    {
        // Code below is only to test permission service.

        // Let's simulate user
        $user = new User();
        $user->id = $_POST['id']; // NOTICE: there is no validation service

        if (!$this->permissionService->can($user, Permission::PERMISSION_CREATE)) {
            throw new PermissionDeniedException();
        }

        return json_encode(['message' => 'Hooray.. you can make POST requests.']);
    }
}
