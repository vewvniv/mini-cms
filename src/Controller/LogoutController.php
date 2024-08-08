<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Controller;

use Ledz\LoginPHP\Interface\Controller;

class LogoutController implements Controller
{
    public function processRequest(): void
    {
        unset($_SESSION['logedin']);
        unset($_SESSION['role']);
        header('Location: /login');
    }
}