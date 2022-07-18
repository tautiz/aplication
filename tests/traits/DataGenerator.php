<?php

namespace Tests\traits;

use App\Models\User;
use App\Models\UserGroup;

trait DataGenerator
{
    /**
     * @param string|null $fakeEmail
     * @param string|null $fakePassword
     * @param string|null $fakeFullName
     * @return User
     */
    private function generateFakeUser(
        ?string $fakeEmail = null,
        ?string $fakePassword = null,
        ?string $fakeFullName = null
    ): User {
        $fakeEmail = $fakeEmail ?? 'fake@email.com';
        $fakePassword = $fakePassword ?? 'fakePassword';
        $fakeFullName = $fakeFullName ?? 'Fake full Name';

        $user = new User();
        $user->setEmail($fakeEmail);
        $user->setPassword($fakePassword);
        $user->setFullName($fakeFullName);

        return $user;
    }

    /**
     * @param string|null $fakeName
     * @return UserGroup
     */
    private function generateFakeGroup(?string $fakeName = null): UserGroup
    {
        $fakeName = $fakeName ?? 'Fake group name';

        return new UserGroup($fakeName);
    }
}
