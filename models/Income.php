<?php

class Income
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function addIncome(
        int $userId,
        float $amount,
        ?string $description
    ): bool {
        $sql = "INSERT INTO incomes (user_id, amount, description)
                VALUES (:user_id, :amount, :description)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':amount' => $amount,
            ':description' => $description
        ]);
    }

    public function getTotalIncome(int $userId): float
    {
        $stmt = $this->db->prepare(
            "SELECT COALESCE(SUM(amount),0) FROM incomes WHERE user_id = :user_id"
        );
        $stmt->execute([':user_id' => $userId]);

        return (float)$stmt->fetchColumn();
    }
}
