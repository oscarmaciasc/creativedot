<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="artistas.css">
    <title>ARTISTS</title>
</head>

<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav" style="justify-content: flex-end;">
        <a href="index.php">HOME</a>
        <a href="productos.php">STORE</a>
        <a href="artistas.php">ARTISTS</a>
        <a href="Server/process-user.php?logout=true">LOGOUT</a>
    </div>
    <div class="HeadHamburguer">
        <div class="hamburguer">
            <div class="bar"></div>
        </div>
    </div>
</header>

<nav class="mobile-nav">
    <a href="index.php">HOME</a>
    <a href="productos.php">STORE</a>
    <a href="artistas.php">ARTISTS</a>
    <a href="#">LOGOUT</a>
</nav>

<body>
    <div class="Container">

    <div class="container-artists">
        <div class="box" id="artistsContainer">
            <!-- Artist cards will be dynamically added here -->
        </div>
    </div>

    <script>
        // Function to create an artist card
        function createCardArtist(artist) {
            const artistContainer = document.getElementById('artistsContainer');

            // Create artist card
            const artistCard = document.createElement('div');
            artistCard.classList.add('artist');

            // Create image element
            const imgElement = document.createElement('img');
            imgElement.src = artist.img; // Assuming your artist object has an 'img' property
            imgElement.alt = '';

            // Create overlay div
            const overlayDiv = document.createElement('div');
            overlayDiv.classList.add('overlay');

            // Create h3 element for artist name
            const h3Element = document.createElement('h3');
            h3Element.textContent = artist.nombre; // Assuming your artist object has a 'nombre' property

            // Create p element for artist description
            const pElement = document.createElement('p');
            pElement.textContent = artist.descripcion; // Assuming your artist object has a 'descripcion' property

            // Append elements to the card
            overlayDiv.appendChild(h3Element);
            overlayDiv.appendChild(pElement);
            artistCard.appendChild(imgElement);
            artistCard.appendChild(overlayDiv);

            // Append the card to the container
            artistContainer.appendChild(artistCard);
        }

        // Fetch data from getArtist.php
        fetch('getArtist.php')
            .then(response => response.json())
            .then(data => {
                // Iterate through the data and create artist cards
                data.forEach(artist => {
                    createCardArtist(artist);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
    </div>

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