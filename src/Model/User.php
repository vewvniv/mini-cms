<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Model;

class User
{
    public function __construct(
        private readonly ?int $id = null,
        public string $email,
        public string $password
    ) {
    }
}