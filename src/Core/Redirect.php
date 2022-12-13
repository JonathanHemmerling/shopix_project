<?php

declare(strict_types=1);

namespace App\Core;

class Redirect implements RedirectInterface
{
    public function to($url): void
    {
        header("Location: " . $url);
        exit();
    }
}