<?php


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
$userId   = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expense Tracker | Dashboard</title>
    <link rel="icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="../assets/styles/index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#a6e1f725] font-sans flex">
    <!-- Sidebar -->
    <nav class="p-[10px] flex justify-between w-full items-center fixed z-12 top-0">
        <div class="flexw"><img width="40" src="../assets/images/logo.png" alt="">
            <h2 class="h1">Expense Tracker</h2>

        </div>
        <h2 class="text-2xl font-bold">Welcome, <?= htmlspecialchars($userName) ?> </h2>

    </nav>
    <aside class="w-56 overflow-hidden rounded-xl bg-gray-800 text-white size-max top-[6%] md:top-[4%]  lg:top-[14%] left-[12px] z-2 fixed flex flex-col">
        
        
            <a href="index.php" class="px-6 py-8 hover:bg-gray-700">Dashboard</a>
            <a href="add-income.php" class="px-6 py-8 hover:bg-gray-700">Add Income</a>
            <a href="add-expense.php" class="px-6 py-8 hover:bg-gray-700">Add Expense</a>
            <a href="../auth/login.php" class="mt-auto px-6 py-8 bg-red-600 text-white text-center hover:bg-red-700">Logout</a>
        
    </aside>