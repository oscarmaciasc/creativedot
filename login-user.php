<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="normalize.css">
    <title>Login</title>
</head>

<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav" style="justify-content: end;">
        <a href="landing.html">HOME</a>
        <a href="login-user.php">LOG IN</a>
        <a href="registro-user.php">REGISTER</a>
    </div>
    <div class="HeadHamburguer">

        <div class="hamburguer">
            <div class="bar"></div>
        </div>
    </div>
</header>

<nav class="mobile-nav">
    <a href="landing.html">HOME</a>
    <a href="login-user.php">LOG IN</a>
    <a href="registro-user.php">REGISTER</a>
</nav>

<body>
    <div class="container">
        <div class="form-login">
            <div class="FormContainer">
                <h1 class="centerTitle">Login</h1>
                <form method="post" action="Server/process-user.php">
                    <div class="form-flex">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" required <?php echo isset($_SESSION['error_message']) ? 'style="border-color: red;"' : ''; ?>>

                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required <?php echo isset($_SESSION['error_message']) ? 'style="border-color: red;"' : ''; ?>>
                    </div>
                    <p class="<?= isset($_SESSION["error_message"]) ? 'error-message' : '' ?>">
                        <?= isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : '' ?>
                    </p>
                    <div>
                        <button type="submit">LOG IN</button>
                    </div>
                    <?php

                    // Display error message if set
                    if (isset($_SESSION["error_message"])) {
                        unset($_SESSION["error_message"]); // Unset the session variable
                    }
                    ?>
                </form>
            </div>
            <div class="img-login">
                <img src="img/login.png" alt="">
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            const menu_btn = document.querySelector('.hamburguer');
            const mobile_menu = document.querySelector('.mobile-nav');
            menu_btn.addEventListener('click', function () {
                menu_btn.classList.toggle('is-active');
                mobile_menu.classList.toggle('is-active');
            })
        }
    </script>
</body>
<footer class="foot">
    <h1>Oscar Alejandro Macias Castillo</h1>
    <h1>4P</h1>
    <h1>Desarrollo Web y Bases de Datos I</h1>
</footer>

</html>