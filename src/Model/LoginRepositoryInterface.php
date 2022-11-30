<?php

declare(strict_types=1);

namespace App\Model;

interface LoginRepositoryInterface
{
    public function findUserByName(string $userName): array;
}