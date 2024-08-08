<?php

declare(strict_types=1);

namespace Ledz\LoginPHP\Controller;

use Ledz\LoginPHP\Repository\UserRepository;

class LoginController extends HTMLController
{
    private ?UserRepository $db = null;

    public function __construct()
    {
        $this->db = new UserRepository();
    }

    public function processRequest(): void
    {
        if (array_key_exists('logedin', $_SESSION) && $_SESSION['logedin'] === true) {
            header('Location: /');
            return;
        }

        $this->render('login');
    }

    public function authenticate(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'pwd');

        if ($email === false || empty($password)) {
            header('Location: /login?login-failed');
            return;
        }

        $user = $this->db->findByEmail($email);

        $correct_pwd = password_verify($password, $user->password ?? '');

        if ($correct_pwd) {
            $_SESSION['logedin'] = true;
            $_SESSION['role'] = $user->role;
            header('Location: /');
        } else {
            header('Location: /login?login-failed');
        }
    }
}
