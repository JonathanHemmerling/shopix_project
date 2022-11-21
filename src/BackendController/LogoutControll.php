<?php

declare(strict_types=1);

namespace App\BackendController;

class LogoutControll
{
    public function __construct()
    {
        $this->logoutUser();
        redirectTo('/../index.php');
    }

    public function logoutUser(): bool
    {
        unset($_SESSION['userName']);
        return true;
    }
}