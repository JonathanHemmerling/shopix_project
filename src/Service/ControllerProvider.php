<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\DetailControll;
use App\Controller\HomeControll;
use App\Controller\ListControll;

class ControllerProvider
{

    public function getList(): array
    {
        return [
            DetailControll::class,
            HomeControll::class,
            ListControll::class,
        ];
    }

    public function getStringOfClass(): string
    {
        $emptyClass = '';
        if (!isset($_GET['page'])) {
            $emptyClass = HomeControll::class;
        }
        if (isset($_GET['productId'])) {
            $emptyClass = ListControll::class;
        }
        if (isset($_GET['id'])) {
            $emptyClass = DetailControll::class;
        }
        return $emptyClass;
    }
}