<?php

declare(strict_types=1);

function redirectTo($location): void
{
    header("Location: " . $location);
    exit();
}



function isLoggedIn(): bool
{
    return isset($_SESSION['userName']);
}
