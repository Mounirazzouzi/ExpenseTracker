<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/config.php";
require_once "../models/Income.php";

require "nav.php";
$db = (new Database())->connect();
$incomeModel = new Income($db);

$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount      = (float) $_POST["amount"];
    $description = trim($_POST["description"]);
    $userId      = $_SESSION["user_id"];

    if ($amount > 0) {
        $incomeModel->addIncome($userId, $amount, $description);
        header("Location: index.php");
        exit;
    } else {
        $message = "Please enter a valid amount.";
    }
}
?>

<head>
 
    <title>Add Income</title>
   
</head>

    <div class="max-w-2xl mx-auto mt-24 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="h1 mb-6 text-center">Add Income</h2>

        <?php if ($message): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="number" name="amount" step="0.01" placeholder="Amount" required
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <textarea name="description" placeholder="Description (optional)"
                      class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded transition-colors">
                Save Income
            </button>
        </form>

    
    </div>
</body>
</html>
