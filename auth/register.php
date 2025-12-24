<?php
session_start();
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../models/User.php";

$db = (new Database())->connect();
$user = new User($db);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];


    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match";
    } elseif ($user->emailExists($email)) {
        $error = "Email already exists";
    } else {
        if ($user->register($name, $email, $password)) {
            $success = "Account created successfully. You can login now.";
        } else {
            $error = "Something went wrong";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="icon" href="../assets/images/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/styles//index.css">
</head>

<body>

    <header>
        <img class="w-[70%] absolute right-0 top-0 " src="../assets/images/bg.png" alt="">
        <div class="rounded-2xl absolute -full md:w-[60%] md:top-[20%] lg:w-[30%] flexw flex-col size-max shadow  left-[2%] p-4 top-[8%] bg-[#a3e8ff59]">
            <h2 class="h1">Register</h2>

            <?php if (!empty($error)): ?>
                <p style="color:red"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <p style="color:green"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <form method="POST" class="w-full">
                <input type="text" name="name" placeholder="Name" required><br><br>

                <input type="email" name="email" placeholder="Email" required><br><br>

                <input type="password" name="password" placeholder="Password" required><br><br>

                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>

                <button class="rounded-2xl bg-[#0000ff] p-2 text-[#fff] w-full font_p" type="submit">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </header>
</body>

</html>