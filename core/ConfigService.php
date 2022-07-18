<?php

namespace Core;

class ConfigService
{
    private array $configs;

    public function __construct()
    {
        // @TODO: LOAd .env file content here
        $this->configs = $_ENV;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function get(string $string): mixed
    {
        return $this->configs[$string] ?? null;
    }
}
