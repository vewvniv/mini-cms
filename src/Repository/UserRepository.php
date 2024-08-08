<?php
declare(strict_types=1);

namespace Ledz\LoginPHP\Repository;

use Ledz\LoginPHP\Db_Connection;
use Ledz\LoginPHP\Interface\UserPDO;
use Ledz\LoginPHP\Model\User;
use PDO;

class UserRepository implements UserPDO
{
    protected PDO $db;
    public function __construct()
    {
        $this->db = Db_Connection::connect();
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare('SELECT FROM users WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

            $user = new User(
                $user_data['id'],
                $user_data['role'],
                $user_data['email'],
                $user_data['password'],
            );
        }

        return $user ?? null;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['id'])) {
            $user_obj = new User(
                $user['id'],
                $user['role'],
                $user['email'],
                $user['password'],
            );
        }

        return $user_obj ?? null;
    }

    public function save(User $user): bool
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        $stmt->bindValue(1, $user->email);
        $stmt->bindValue(2, $user->password);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(User $user): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET email = ?, password = ? WHERE id = ?');
        $stmt->bindValue(1, $user->email);
        $stmt->bindValue(2, $user->password);
        $stmt->bindValue(3, $user->id);

        return $stmt->execute();
    }
}