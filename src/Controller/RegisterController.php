<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Controller;

use Ledz\LoginPHP\Model\User;
use Ledz\LoginPHP\Repository\UserRepository;

require_once __DIR__ . '/../../vendor/autoload.php';

class RegisterController extends HTMLController
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

        $this->render('register');
    }

    public function register(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'pwd');

        if ($email === false || empty($password)) {
            http_response_code(400);
            header('Location: /register?register-failed');
            return;
        }

        $hash = password_hash($password, PASSWORD_ARGON2ID);

        if ($this->db->save(new User(null, $email, $hash))) {
            header('Location: /login?register-success');
            return;
        } else {
            header('Location: /register?register-failed');
            return;
        }

    }
}
