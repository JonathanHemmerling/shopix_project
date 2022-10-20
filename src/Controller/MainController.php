<?php

declare(strict_types=1);
namespace App\Controller;
use App\Interfaces\ControllerInterface;

class MainController{

    public function setController():array{
        $controllerList = [];
        foreach ($controller as $item) {
            $controllerList = $item->getParameterSetInURL();
        }
        return $controllerList;
    }
}