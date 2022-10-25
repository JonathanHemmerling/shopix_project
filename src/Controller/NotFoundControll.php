<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;


class NotFoundControll
{
    private string $error = 'Page not found';
    public function __construct()
    {
        echo $this->error;
    }
}