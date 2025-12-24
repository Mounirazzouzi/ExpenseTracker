<?php

class Expense
{
    private PDO $conn;
    private string $table = "expenses";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function create(
        int $user_id,
        float $amount,
        string $category,
        ?string $description,
        string $expense_date
    ): bool {
        $sql = "INSERT INTO {$this->table}
                (user_id, amount, category, description, expense_date)
                VALUES
                (:user_id, :amount, :category, :description, :expense_date)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':user_id' => $user_id,
            ':amount' => $amount,
            ':category' => $category,
            ':description' => $description,
            ':expense_date' => $expense_date
        ]);
    }

    public function getTotalByUser(int $user_id): float
    {
        $stmt = $this->conn->prepare(
            "SELECT COALESCE(SUM(amount),0) FROM {$this->table} WHERE user_id = :user_id"
        );
        $stmt->execute([':user_id' => $user_id]);
        return (float)$stmt->fetchColumn();
    }

    /* 🔥 الرسم البياني */
    public function getExpensesByCategory(int $user_id): array
    {
        $sql = "SELECT category, SUM(amount) AS total
                FROM {$this->table}
                WHERE user_id = :user_id
                GROUP BY category";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRecentExpenses(int $user_id, int $limit = 5): array
    {
        $sql = "SELECT amount, category, description, expense_date
            FROM {$this->table}
            WHERE user_id = :user_id
            ORDER BY expense_date DESC
            LIMIT :limit";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
