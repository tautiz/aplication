<?php

namespace App\Models;

/**
 * @property int $id
 * @property string $name
 */
class UserGroup implements ModelInterface
{
    use DateFields;

    /**
     * @param string $name
     */
    public function __construct(protected string $name)
    {
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
