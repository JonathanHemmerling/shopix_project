<?php

declare(strict_types=1);

namespace App\Core;

interface RedirectInterface
{
    public function to($url): void;
}