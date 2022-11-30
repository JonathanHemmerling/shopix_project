<?php

declare(strict_types=1);

namespace App\Core;

interface SessionInterface
{
    public function loginUser(): void;

    public function logoutUser(): bool;
}