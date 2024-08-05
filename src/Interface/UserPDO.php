<?php
declare(strict_types=1);
namespace Ledz\LoginPHP\Interface;

use Ledz\LoginPHP\Model\User;

interface UserPDO
{
    public function findById(int $id): ?User;
    public function save(User $user): bool;
    public function delete(int $id): bool;
    public function update(User $user): bool;
}
