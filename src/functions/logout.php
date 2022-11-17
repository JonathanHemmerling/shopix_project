<?php
declare(strict_types=1);
require_once __DIR__.'/initialize.php';

function logoutUser(): bool
{
    unset($_SESSION['userName']);
    return true;
}
logoutUser();
redirectTo('/../index.php');