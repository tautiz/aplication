<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\traits\DataGenerator;

class UserTest extends TestCase
{
    use DataGenerator;

    /**
     * @return void
     */
    public function testGetEmail(): void
    {
        $fakeEmail = 'fake@email.com';
        $user = $this->generateFakeUser(fakeEmail: $fakeEmail);

        $this->assertIsString($user->getEmail());
        $this->assertStringContainsStringIgnoringCase($fakeEmail, $user->getEmail());
    }

    /**
     * @return void
     */
    public function testSetEmail(): void
    {
        $fakeEmail = 'fake+new@email.com';
        $user = $this->generateFakeUser();
        $user->setEmail($fakeEmail);

        $this->assertIsString($user->getEmail());
        $this->assertStringContainsStringIgnoringCase($fakeEmail, $user->getEmail());
    }

    /**
     * @return void
     */
    public function testGetPassword(): void
    {
        $fakePassword = 'TestablePassword';
        $user = $this->generateFakeUser(fakePassword: $fakePassword);

        $this->assertIsString($user->getPassword());
        $this->assertStringContainsStringIgnoringCase($fakePassword, $user->getPassword());
    }

    /**
     * @return void
     */
    public function testSetPassword(): void
    {
        $fakePassword = 'TestablePassword';
        $user = $this->generateFakeUser();
        $user->setPassword($fakePassword);

        $this->assertIsString($user->getPassword());
        $this->assertStringContainsStringIgnoringCase($fakePassword, $user->getPassword());
    }

    /**
     * @return void
     */
    public function testGetFullName(): void
    {
        $fakeFullName = 'Fake Full Name';
        $user = $this->generateFakeUser(fakeFullName: $fakeFullName);

        $this->assertIsString($user->getFullName());
        $this->assertStringContainsStringIgnoringCase($fakeFullName, $user->getFullName());
    }

    /**
     * @return void
     */
    public function testSetFullName(): void
    {
        $fakeFullName = 'Fake Full Name';
        $user = $this->generateFakeUser();
        $user->setFullName($fakeFullName);

        $this->assertIsString($user->getFullName());
        $this->assertStringContainsStringIgnoringCase($fakeFullName, $user->getFullName());
    }
}
