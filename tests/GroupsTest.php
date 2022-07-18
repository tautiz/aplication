<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\traits\DataGenerator;

class GroupsTest extends TestCase
{
    use DataGenerator;

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $fakeName = 'Test fake group name';
        $group = $this->generateFakeGroup($fakeName);

        $this->assertIsString($group->getName());
        $this->assertStringContainsStringIgnoringCase($fakeName, $group->getName());
    }

    /**
     * @return void
     */
    public function testSetName(): void
    {
        $fakeName = 'Test fake group name';
        $group = $this->generateFakeGroup();
        $group->setName($fakeName);

        $this->assertIsString($group->getName());
        $this->assertStringContainsStringIgnoringCase($fakeName, $group->getName());
    }
}
