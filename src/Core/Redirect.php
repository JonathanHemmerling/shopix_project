<?php

declare(strict_types=1);

namespace App\Core;

use JetBrains\PhpStorm\NoReturn;

class Redirect implements RedirectInterface
{
    #[NoReturn]
    public function to($url): void
    {
        header("Location: " . $url);
        exit();
    }
}