<?php

declare(strict_types=1);

namespace App\Core;

class Session implements SessionInterface
{

    public function loginUser(): void
    {
        session_regenerate_id();
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = $_POST['userName'];
    }

    public function logoutUser(): bool
    {
        unset($_SESSION['userName']);
        return true;
    }

}