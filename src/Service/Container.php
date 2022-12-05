<?php

declare(strict_types=1);

namespace App\Service;

class Container
{

    private array $objects = [];

    public function __construct()
    {
    }

    public function set(string $class, object $newObject): void
    {
            $this->objects[$class] = $newObject;
    }

    public function get(string $class)
    {
        return $this->objects[$class];
    }


}