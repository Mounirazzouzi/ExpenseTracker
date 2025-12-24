<?php
session_start();

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../models/User.php";

$db = (new Database())->connect();
$user = new User($db);

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $user->login($email, $password);

    if ($result) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['name'];

        header("Location: ../dashboard/index.php");
        exit;
    } else {
        $error = "Email or password incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="../assets/images/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/styles//index.css">
</head>

<body>
    <header class="flex-wrap flexw">
        <img class="w-[70%] absolute right-0 top-0 " src="../assets/images/bg.png" alt="">
        <div class="rounded-2xl absolute w-full md:w-[60%] md:top-[20%] lg:w-[30%] flexw flex-col size-max shadow left-[4%] p-4 top-[14%] bg-[#a3e8ff59]">
            <h2 class="h1">Login</h2>

            <?php if (!empty($error)): ?>
                <p style="color:red"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" class="w-full">
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <button class="rounded-2xl bg-[#0000ff] p-2 text-[#fff] w-full font_p" type="submit">Login</button>
                
                
            </form><p>Create an account now.<a href="register.php">sign Us</a></p>
        </div>
    </header>
</body>

</html>