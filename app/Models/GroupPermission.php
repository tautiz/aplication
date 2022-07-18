<?php

namespace App\Models;


/**
 * @property int $id
 * @property string $group_id
 * @property string $permission
 */
class GroupPermission implements ModelInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGroupId(): string
    {
        return $this->group_id;
    }

    /**
     * @param string $group_id
     */
    public function setGroupId(string $group_id): void
    {
        $this->group_id = $group_id;
    }

    /**
     * @return string
     */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
     * @param string $permission
     */
    public function setPermission(string $permission): void
    {
        $this->permission = $permission;
    }
}
