<?php

declare(strict_types=1);

namespace App\Core;

class Session implements SessionInterface
{

    public function loginUser(int $userId): void
    {
        session_regenerate_id();
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['userId'] = $userId;
    }

    public function loginAdmin(): void
    {
        session_regenerate_id();
        $_SESSION['lastLogin'] = time();
        $_SESSION['adminName'] = $_POST['adminName'];
    }

    public function logoutUser(): void
    {
        unset($_SESSION['userName']);
        unset($_SESSION['adminName']);
    }

}