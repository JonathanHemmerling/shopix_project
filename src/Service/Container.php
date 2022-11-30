<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\View;

class Container
{
    protected $parameters = array();
    private array $Objects = [];

    public function __construct(array $parameters = array())
    {
        $this->parameters = $parameters;
    }

    public function set(string $class, Object $newObject): void
    {
        $this->Objects[$class] = $newObject;
    }

    public function get(string $class)
    {
        return $this->Objects[$class];
    }


}