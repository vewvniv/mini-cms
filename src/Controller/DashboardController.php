<?php
declare(strict_types= 1);

namespace Ledz\LoginPHP\Controller;

class DashboardController extends HTMLController
{
    public function processRequest(): void
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
            $this->render('dashboard');
        } else {
            header('Location: /');
            return;
        }
    }
}
