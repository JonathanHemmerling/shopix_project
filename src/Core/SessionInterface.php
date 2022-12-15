<?php

declare(strict_types=1);

namespace App\Core;

interface SessionInterface
{
    public function loginUser(int $userId): void;

    public function logoutUser(): void;
}