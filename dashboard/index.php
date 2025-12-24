<?php
session_start();

// حماية الصفحة
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/config.php";
require_once "../models/Income.php";
require_once "../models/Expense.php";
require "nav.php";
$db = (new Database())->connect();
$incomeModel  = new Income($db);
$expenseModel = new Expense($db);

$userId   = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

$totalIncome  = $incomeModel->getTotalIncome($userId);
$totalExpense = $expenseModel->getTotalByUser($userId);
$balance      = $totalIncome - $totalExpense;

$expensesByCategory = $expenseModel->getExpensesByCategory($userId);

$categories = [];
$amounts = [];

foreach ($expensesByCategory as $row) {
    $categories[] = $row['category'];
    $amounts[]    = $row['total'];
}
$recentExpenses = $expenseModel->getRecentExpenses($userId);

?>

    

    <!-- Main content -->
    <main class="ml-56 flex-1 p-8 mt-20">
        

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <h3 class="text-gray-500 font-medium">Total Income</h3>
                <p class="text-2xl font-bold mt-2">$<?= number_format($totalIncome, 2) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
                <h3 class="text-gray-500 font-medium">Total Expenses</h3>
                <p class="text-2xl font-bold mt-2">$<?= number_format($totalExpense, 2) ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <h3 class="text-gray-500 font-medium">Current Balance</h3>
                <p class="text-2xl font-bold mt-2">$<?= number_format($balance, 2) ?></p>
            </div>
        </div>

        <!-- Chart -->
        <div class="flexw">
            <div class="bg-white p-6 mt-8 rounded-lg shadow w-[30%] ">
                <h3 class="text-lg font-semibold mb-4">Expenses Overview</h3>
                <canvas
                    id="expenseChart"
                    data-labels='<?= json_encode($categories, JSON_UNESCAPED_UNICODE) ?>'
                    data-values='<?= json_encode($amounts, JSON_NUMERIC_CHECK) ?>'>
                </canvas>
            </div>
            <!-- Recent Expenses -->
            <div class="bg-white p-6 mt-8 rounded-lg shadow w-[65%]">

                <h2 class=" font-semibold mb-4 font_p">Recent Expenses</h2>

                <table class="w-full text-sm text-left font_p">
                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="py-2 font_p" >Amount</th>
                            <th class="font_p">Category</th>
                            <th class="font_p">Description</th>
                            <th class="font_p">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($recentExpenses)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-400">
                                    No expenses found
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentExpenses as $exp): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 font-semibold text-red-500">
                                        $<?= number_format($exp['amount'], 2) ?>
                                    </td>

                                    <td>
                                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-600">
                                            <?= htmlspecialchars($exp['category']) ?>
                                        </span>
                                    </td>

                                    <td class="text-gray-600">
                                        <?= htmlspecialchars($exp['description'] ?? '-') ?>
                                    </td>

                                    <td class="text-gray-500">
                                        <?= date('d M Y', strtotime($exp['expense_date'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>

        </div>
    </main>


    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->


    <script src="../assets/js/Chart.js"></script>

</body>

</html>