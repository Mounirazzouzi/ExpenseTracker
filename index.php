<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <nav class="flexw sticky py-2 top-0 z-12">
        <div class="flexw"><img width="40" src="assets/images/logo.png" alt="">
            <h2 >Expense Tracker</h2>
        </div>
        <ul class="flexw">
            <li>
                <a href="#">home</a>

            </li>
            <li>
                <a href="#fatu">fatures</a>

            </li>
            <li>
                <a href="#contact">contact</a>

            </li>
        </ul>
        <div class="flexw"><a class="bg-[#0000ff] p-2 text-[#fff] rounded-2xl" href="auth/login.php">login</a><a class="bg-[#00ff00] p-2 text-[#fff] rounded-2xl" href="auth/register.php">sign up</a></div>
    </nav>
    <header>
        <img class="w-[70%] absolute right-0 top-0 " src="assets/images/bg.png" alt="">
        <div class="absolute top-[40%] left-[4%]">
            <h1 class="h1 py-[8px]">Take control of you income & expenses easily !</h1>
            <p class="py-4 text-xl">Track you income and expenses and stay on top of you finances anytime</p>
            <div class="flexw w-[150px]">
                <a class="bg-[#0000ff] p-2 text-[#fff] rounded-2xl" href="auth/login.php">login</a>
                <a class="bg-[#00ff00] p-2 text-[#fff] rounded-2xl" href="auth/register.php">sign up</a>
           </div>
        </div>
    </header>
    <section class="py-4" id="fatu">
        <div class="sec-top flexw flex-wrap">
            <div class="card">
                <p class="w-[58%]">Easily Add Your Income & Expenses</p>
                <img src="" alt="">
            </div>
            <div class="card">
                <p class="w-[58%]">View Reports & Breakdown Charts</p>
                <img src="" alt="">
            </div>
            <div class="card">
                <p class="w-[58%]">Track Your Current Balance Anytime</p>
                <img src="" alt="">
            </div>
        </div>
        <h2 class="h1 py-[10px]">A look at the dashboard</h2>
        <div class="sec-butt"><img class="rounded-2xl w-[88%]" src="assets/images/dash.png" alt=""></div>
    </section>
    
        <p>let's work together</p>

        <div class="flex gap-14 text-2xl">
            <a href=""><i class="fa-brands fa-facebook  text-[#ff0000] ico"></i></a>
            <a href=""><i class="fa-brands fa-instagram text-[#ff0000] ico"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp  text-[#ff0000] ico"></i></a>
            <a href=""><i class="fa-regular fa-envelope text-[#ff0000] ico"></i></a>
        </div>
        <div class=""></div>
        <p class="pt-[10px] border-t-4 border-[#fff] w-[98%] md:w-[98%] lg:w-[65%] text-center">
            &copy; 2025 Panda Shop. All rights reserved.
        </p>


    </footer>
</body>

</html>
