<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Model;

class User
{
    public function __construct(
        public readonly ?int $id = null,
        public string $role = 'user',
        public string $email,
        public string $password
    ) {
    }
}