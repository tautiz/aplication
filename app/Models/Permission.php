<?php

namespace App\Models;

/**
 * @property int $id
 * @property string $name
 */
class Permission implements ModelInterface
{
    public const PERMISSION_SHOW = 'show';
    public const PERMISSION_CREATE = 'create';
    public const PERMISSION_UPDATE = 'update';
    public const PERMISSION_DELETE = 'delete';
}
