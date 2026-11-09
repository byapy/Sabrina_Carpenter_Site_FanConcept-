<?php
declare(strict_types=1);

require_once __DIR__ . '/controllers/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/icons/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sabrina Carpenter - Login</title>
</head>
<body class="relative min-h-screen">
    <div class="fondo  md:bg-fixed blur-xs ">
    
    </div>
    <header>
        <button type="button" onclick="history.back()"  class="outline-1 rounded-2xl border-amber-700 p-2 min-h-5 bg-black/40 text-white font-bold m-3 hover:bg-black/50">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-8 h-5">
            <path d="M 52 20 H 78 C 82.4 20 86 23.6 86 28 V 72 C 86 76.4 82.4 80 78 80 H 52" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M 64 50 H 14 M 32 32 L 14 50 L 32 68" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </header>
    <main class="login-content flex justify-center-safe">
        

        <div  id="Auth-feed"  class="form-box rounded-2xl bg-white/90  p-5 shadow-2xl m-2 flex justify-center-safe flex-col backdrop-blur-md border border-white/50 w-150">
            <form action="login.php" method="post" id="login-box" >
                <h2 class="text-2xl  font-bold text-center">Login</h2>
                <?php if ($loginError !== ''): ?>
                    <p class="my-3 rounded-md bg-red-100 p-3 text-sm text-red-700" role="alert">
                        <?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                <label for="" class="block">Email Address</label>
                <input type="email" name="eml_email" id="eml_email" data-placeholder="email" 
                class="w-full 
                h-12 p-4
                placeholder-stone-400
                invalid:border-red-500  
                after:ml-0.5
                after:text-red-500 after:content-['*']
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                " required>

                <label for="" class="block">Password</label>
                <input type="password" name="pwd_password" id="pwd_password"  data-placeholder="contrasena"  class="
                w-full 
                h-12
                p-4
                placeholder-stone-400
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                " required>
                
                <button type="submit" name="login_submit" value="1" class="w-2/3 rounded-2xl  block mx-auto  h-12 bg-orange-100  hover:bg-orange-200 mt-5 border border-amber-400" >Sign in</button>
            </form>

            <form action="login.php" method="post" id="register-box" class="<?= $showRegistrationForm ? '' : 'hidden' ?>">
                <h2 class="text-2xl  font-bold text-center">Create Account</h2>
                <?php if ($registerError !== ''): ?>
                    <p class="my-3 rounded-md bg-red-100 p-3 text-sm text-red-700" role="alert">
                        <?= htmlspecialchars($registerError, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                <label for="">First Name</label> 
                <input type="text" name="txt_name" id="txt_name" data-placeholder="nombre" 
                class="w-full 
                h-12 p-4
                placeholder-stone-400
                invalid:border-red-500  
                after:ml-0.5
                after:text-red-500 after:content-['*']
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                " required>
                
                <label for="">Last Name</label>  
                <input type="text" name="txt_apellido" id="txt_apellido" data-placeholder="apellido" 
                class="w-full 
                h-12 p-4
                placeholder-stone-400
                invalid:border-red-500  
                after:ml-0.5
                after:text-red-500 after:content-['*']
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                " required>

                <label for="" class="block">Email Address</label> 
                <input type="email" name="eml_email_register" id="eml_email-register" data-placeholder="email" 
                class="w-full 
                h-12 p-4
                placeholder-stone-400
                invalid:border-red-500  
                after:ml-0.5
                after:text-red-500 after:content-['*']
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                " required>

                <label for="" class="">Address</label> <span class="font-light text-gray-400">Optional</span>
                <input type="text" name="txt_direccion" id="txt_direccion" data-placeholder="direccion" maxlength="300"
                class="w-full 
                h-12 p-4
                placeholder-stone-400
                invalid:border-red-500  
                after:ml-0.5
                after:text-red-500 after:content-['*']
                outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400
                rounded-b-sm
                my-3
                ">
                <label for="pwd_register" class="block">Password</label>
                <input type="password" name="pwd_register" id="pwd_register" minlength="8" autocomplete="new-password" data-placeholder="contrasena"
                class="w-full h-12 p-4 placeholder-stone-400 outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400 rounded-b-sm my-3" required>

                <label for="pwd_register_confirmation" class="block">Confirm Password</label>
                <input type="password" name="pwd_register_confirmation" id="pwd_register_confirmation" minlength="8" autocomplete="new-password" data-placeholder="contrasena"
                class="w-full h-12 p-4 placeholder-stone-400 outline-2 outline-yellow-500 focus:outline-orange-500 transition hover:outline-yellow-400 rounded-b-sm my-3" required>

                <button class="w-2/3 rounded-2xl block mx-auto h-12 bg-orange-100 hover:bg-orange-200 mt-5 border border-amber-400" name="register_submit" value="1" type="submit">Create Account</button>
            </form>
            <br>
            <div class="flex items-center gap-4 my-4">
                <hr class="border-gray-200 flex-1">
                <span class=" font-bold opacity-70  leading-none">Or</span>
                <hr class="border-gray-200 flex-1">
            </div>

            <section class="register-box  flex flex-col justify-center items-center-safe">
                <button type="button" id="btn-register" class="w-2/3 rounded-2xl h-12 justify-self-auto hover:bg-orange-200 mt-3 border border-amber-400 <?= $showRegistrationForm ? 'hidden' : '' ?>">Create New Account</button>

                <button type="button" id="btn-login" class="w-2/3 rounded-2xl h-12 justify-self-auto hover:bg-orange-200 mt-3 border border-amber-400 <?= $showRegistrationForm ? '' : 'hidden' ?>" >Login My Account</button>
                
            </section>
        </div>
        
    </main>

<script src="js/auth.js"></script>
</body>
</html>

