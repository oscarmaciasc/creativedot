<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-products.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Outfit:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/65ffebf137.js" crossorigin="anonymous">
    </script>
    <title>Artists</title>
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
    <div class="Container">

        <div class="CardContainer" id="CardContainer">

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const productContainer = document.getElementById('CardContainer');

                    // Fetch product data from the server
                    fetch('getArtist.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Display product cards
                            data.forEach(artist => {
                                const card = createProductCard(artist);
                                productContainer.appendChild(card);
                            });
                        })
                        .catch(error => console.error('Error fetching artist data:', error));
                });

                function createProductCard(artist) {
                    const card = document.createElement('div');
                    card.classList.add('Card');

                    const cardImg = document.createElement('div');
                    cardImg.classList.add('CardImg');

                    const floatInfo = document.createElement('div');
                    floatInfo.classList.add('floatInfo');
                    floatInfo.style.width = '80%'; // Set width to 80%

                    const title = document.createElement('h1');
                    title.innerHTML = `${artist.nombre}`;
                    floatInfo.appendChild(title); // Append the title element, not a string

                    const description = document.createElement('p');
                    description.innerHTML = `${artist.descripcion}`;
                    floatInfo.appendChild(description);

                    const floatDelete = document.createElement('div');
                    floatDelete.classList.add('floatDelete');
                    floatDelete.style.width = '20%'; // Set width to 20%
                    floatDelete.style.display = 'flex';
                    floatDelete.style.justifyContent = 'flex-end';
                    floatDelete.style.alignItems = 'flex-end';

                    const deleteDiv = document.createElement('div');
                    deleteDiv.classList.add('deleteButton');

                    const deleteButton = document.createElement('button');

                    deleteButton.addEventListener('click', function() {
                        // Send an AJAX request to deleteProduct.php with the product ID
                        console.log('Deleting artist with ID:', artist.idArtista);

                        fetch('deleteArtist.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    artistID: artist.idArtista
                                }), // Assuming there's a unique identifier like 'id'
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Product deleted:', data);
                                // Optionally, you can also remove the product card from the UI
                                card.remove();
                            })
                            .catch(error => console.error('Error deleting artist:', error));
                    });


                    const deleteIcon = document.createElement('i');
                    deleteIcon.classList.add('fa-solid');
                    deleteIcon.classList.add('fa-circle-minus');
                    deleteIcon.classList.add('fa-lg');
                    deleteIcon.style.setProperty('color', '#e91616');
                    deleteIcon.style.setProperty('background', 'none');

                    deleteButton.appendChild(deleteIcon);

                    // Form Container
                    const formContainer = document.createElement('div');
                    formContainer.classList.add('formContainer');

                    // Form
                    const form = document.createElement('form');
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', 'edit_artist.php');

                    // Hidden input for nombre
                    const inputNombre = createHiddenInput('nombre', artist.nombre);
                    form.appendChild(inputNombre);
                    
                    // Hidden input for descripcion
                    const inputDescripcion = createHiddenInput('descripcion', artist.descripcion);
                    form.appendChild(inputDescripcion);
                    
                    // Hidden input for idArtista
                    
                    const inputId =createHiddenInput('idArtista', artist.idArtista);
                    form.appendChild(inputId);

                    formContainer.appendChild(form);

                    // Append form container to floatInfo and delete button to floatDelete
                    floatInfo.appendChild(formContainer);
                    floatDelete.appendChild(deleteDiv);
                    deleteDiv.appendChild(deleteButton);

                    // Attach click event listener to floatInfo
                    floatInfo.addEventListener('click', function() {
                        // Trigger form submission when floatInfo is clicked
                        form.submit();
                        console.log('click en floatInfo');
                    });

                    const img = document.createElement('img');
                    img.src = "http://localhost/Creative/" + artist.img; // Replace with the actual path to your product image
                    img.alt = 'Artist Image';
                    cardImg.appendChild(img);

                    const cardInfo = document.createElement('div');
                    cardInfo.classList.add('CardInfo');
                    cardInfo.style.display = 'flex';
                    cardInfo.style.flexDirection = 'row';
                    cardInfo.appendChild(floatInfo);
                    cardInfo.appendChild(floatDelete);

                    card.appendChild(cardImg);
                    card.appendChild(cardInfo);

                    return card;
                }

                function createHiddenInput(name, value) {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', name);
                    input.setAttribute('value', value);
                    return input;
                }
            </script>

            <div class="Card">
                <form class="Add" action="add_artist.html" method="post">
                    <button type="submit" class="Add">

                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
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
    <h1><strong>Created By: </strong>Oscar Alejandro Macias Castillo.</h1>
    <h1><strong>From: </strong>4P Software Development - Database and Web Development.</h1>
</footer>

</html>