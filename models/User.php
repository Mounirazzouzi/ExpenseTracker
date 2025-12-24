<?php

class User
{
    private PDO $conn;
    private string $table = "users";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    /* =========================
       Register (Create User)
    ========================= */
    public function register(string $name, string $email, string $password): bool
    {
        $sql = "INSERT INTO {$this->table} (name, email, password)
                VALUES (:name, :email, :password)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':name'     => htmlspecialchars($name),
            ':email'    => htmlspecialchars($email),
            ':password' => $hashedPassword
        ]);
    }

    /* =========================
       Login
    ========================= */
    public function login(string $email, string $password): array|false
    {
        $sql = "SELECT id, name, email, password
                FROM {$this->table}
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // حماية
            return $user;
        }

        return false;
    }

    /* =========================
       Get User By ID
    ========================= */
    public function getById(int $id): array|false
    {
        $sql = "SELECT id, name, email, created_at
                FROM {$this->table}
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }

    /* =========================
       Check Email Exists
    ========================= */
    public function emailExists(string $email): bool
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->rowCount() > 0;
    }
}
