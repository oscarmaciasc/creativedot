<?php
include 'Server/session.php';
// echo "Rol: " . $userRole;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Outfit:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/65ffebf137.js" crossorigin="anonymous"></script>
    <title>Pagina Web</title>
</head>

<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav">
        <a href="index-admin.php">HOME</a>
        <a href="admin-products.php">PRODUCTS</a>
        <a href="admin-artists.php">ARTISTS</a>
        <a href="log.php">LOG</a>
        <a href="Server/process-user.php?logout=true">LOGOUT</a>
    </div>
    <div class="HeadHamburguer">

        <div class="hamburguer">
            <div class="bar"></div>
        </div>
    </div>
</header>

<nav class="mobile-nav">
    <a href="index-admin.php">HOME</a>
    <a href="admin-products.php">STORE</a>
    <a href="admin-artists.php">ARTISTS</a>
    <a href="log.php">LOG</a>
    <a href="Server/process-user.php?logout=true">LOGOUT</a>
</nav>

<body>
    <section>
        <div class="LandingContainer">
            <div class="ImgContainer">
                <img class="ImgBig" src="http://localhost/creative/img/art01.png" alt="">
            </div>
            <div class="TitleFloatLeft">
                <a href="admin-products.php">
                    <div class="circle"></div>
                </a>

                <a href="admin-artists.php">
                    <div class="circle2"></div>
                </a>
                <h1>Where Art meets People</h1>
                <h2>Discover new talent.</h2>
                <h2>Embrace local art.</h2>
                <h2>Enjoy life.</h2>
            </div>
        </div>
    </section>
    <section>
        <div class="CardContainer">
            <div class="Cards">
                <div class="Card">
                    <div class="CardInfo">
                        <h1>Mission</h1>
                        <h2>At <strong>creative.dot</strong>, our mission is to celebrate and elevate local artistry,
                            providing
                            a vibrant platform for emerging artists to showcase their creativity. We are committed to
                            fostering
                            a thriving community that values and supports the diverse talents of our region. Through
                            collaboration, innovation, and a deep appreciation for the arts, we aim to enrich lives and
                            inspire
                            cultural growth.</h2>

                    </div>
                </div>
                <div class="Card">
                    <div class="CardInfo">
                        <h1>Vision</h1>
                        <h2>"Our vision at <strong>creative.dot</strong> is to become the heart of our community's
                            artistic expression, a haven where local artists find encouragement, recognition, and a
                            welcoming audience. By
                            embracing and promoting the beauty of our local culture, we aspire to create lasting
                            connections and empower the next generation of artists to thrive."</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slide">
        <div class="AboutUsContainer">
            <div class="Map">

                <img src="img/setup.png" alt="" class="MapImg">
            </div>
            <div class="Aboutus" id="about-us">
                <h1 class="Iam">Who am I?</h1>
                <hr>
                <h2 class="AboutContent">Im a Software Developer based in Mexico!
                    What sets me apart is my burning passion for art, video games, and design. 🎨🎮💻
                    You see, I believe that the web is a canvas where I can blend technology and creativity to craft
                    stunning digital experiences. Whether it's building a sleek website or developing an interactive
                    game, I infuse my work with an artistic touch.
                </h2>
            </div>
        </div>
    </section>

    <script>
        window.onload = function() {
            const menu_btn = document.querySelector('.hamburguer');
            const mobile_menu = document.querySelector('.mobile-nav');
            menu_btn.addEventListener('click', function() {
                menu_btn.classList.toggle('is-active');
                mobile_menu.classList.toggle('is-active');
            })
        }
    </script>
</body>
<footer class="foot">
    <h2><strong>Created By: </strong>Oscar Alejandro Macias Castillo.</h2>
    <h2><strong>From: </strong>4P Software Development - Database and Web Development.</h2>
</footer>

</html>