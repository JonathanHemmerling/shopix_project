<?php

declare(strict_types=1);

namespace App\Model;

interface LoginRepositoryInterface
{
    public function findAdminByName(string $userName): array;

    public function findUserByName(string $userName): array;
}