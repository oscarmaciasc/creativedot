<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <link rel="stylesheet" href="normalize.css">
    <title>Registro</title>
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
        <div class="img-register">
            <img src="img/register.png" alt="">
        </div>
        <div class="form-register">
            <div class="FormContainer">
                <h1 class="centerTitle">Registro</h1>
                <form method="post" action="server/process-user.php">
                    <div class="form-flex">
                        <label for="new_username">Nombre de Usuario</label>
                        <input type="text" id="new_username" name="new_username" required>
                        <label for="new_password">Contraseña</label>
                        <input type="password" id="new_password" name="new_password" autocomplete="on">
                        <label for="email">Correo Electronico</label>
                        <input type="text" id="email" name="email">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre">
                        <div class="separate-flex">
                            <div class="separate">
                                <label for="paterno">Apellido Paterno</label>
                                <input type="text" id="paterno" name="paterno">
                                <label for="cp">Codigo Postal</label>
                                <input type="number" id="cp" name="cp">
                            </div>
                            <div class="separate">
                                <label for="materno">Apellido Materno</label>
                                <input type="text" id="materno" name="materno">
                                <label for="cellphone">Numero de telefono</label>
                                <input type="number" id="cellphone" name="cellphone">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit">Registrar</button>
                    </div>
                </form>
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