<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../models/Expense.php";
require "nav.php";

$db = (new Database())->connect();   
$expense = new Expense($db);

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount = floatval($_POST['amount']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $expense_date = $_POST['expense_date'];

    if ($expense->create($_SESSION['user_id'], $amount, $category, $description, $expense_date)) {
        $success = "Expense added successfully!";
    } else {
        $error = "Failed to add expense.";
    }
}
?>
<head>
    <title>Add Expense</title>
</head>
    <div class="max-w-2xl mx-auto  mt-24 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="h1 mb-6 text-center">Add Expense</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="number" step="0.01" name="amount" placeholder="Amount" required
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input type="text" name="category" placeholder="Category" required
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <textarea name="description" placeholder="Description"
                      class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            <input type="date" name="expense_date" value="<?= date('Y-m-d') ?>" required
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded transition-colors">
                Add Expense
            </button>
        </form>

    
    </div>
</body>
</html>
