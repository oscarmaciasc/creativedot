<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="productos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/65ffebf137.js" crossorigin="anonymous"></script>
    <title>Productos</title>
</head>
<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav">
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
    <a href="Server/process-user.php?logout=true">LOGOUT</a>
</nav>

<body>
    <div class="Container" id="Container">

        <div class="title-header">
            <div class="title">PRODUCT LIST</div>
            <div class="icon-cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="shoppingQuantity">0</span>
            </div>
        </div>

        <div class="CardContainer" id="CardContainer">

            <script>
                window.onload = function() {
                    const menu_btn = document.querySelector('.hamburguer');
                    const mobile_menu = document.querySelector('.mobile-nav');
                    menu_btn.addEventListener('click', function() {
                        menu_btn.classList.toggle('is-active');
                        mobile_menu.classList.toggle('is-active');
                    })
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const productContainer = document.getElementById('CardContainer');
                    const listCart = document.getElementById('listCart');


                    // Fetch product data from the server
                    fetch('getProducts.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Display product cards
                            data.forEach(product => {
                                const card = createProductCard(product);
                                productContainer.appendChild(card);
                            });
                        })
                        .catch(error => console.error('Error fetching product data:', error));


                    fetch('getCart.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(cartItem => {
                                const cardCart = createCartCard(cartItem);
                                listCart.appendChild(cardCart);
                            });
                        })
                        .catch(error => console.error('Error fetching product data:', error));

                    fetch('getShoppingQuantity.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Update the quantity in the icon-cart span
                            const iconCart = document.querySelector('.shoppingQuantity');
                            if (iconCart) {
                                iconCart.textContent = data.totalQuantity;
                            }
                        })
                        .catch(error => console.error('Error fetching shopping quantity:', error));
                });

                function createProductCard(product) {
                    const card = document.createElement('div');
                    card.classList.add('Card');

                    const cardImg = document.createElement('div');
                    cardImg.classList.add('CardImg');

                    const img = document.createElement('img');
                    img.src = product.img; // Replace with the actual path to your product image
                    img.alt = 'Product Image';
                    cardImg.appendChild(img);


                    const form = document.createElement('form');


                    form.setAttribute('method', 'post');
                    form.setAttribute('action', 'add_to_cart.php');


                    // Hidden input for product_id
                    const inputID = document.createElement('input');
                    inputID.setAttribute('type', 'hidden');
                    inputID.setAttribute('name', 'product_id');
                    inputID.setAttribute('value', product.idProducto);
                    form.appendChild(inputID);

                    const inputQuantity = document.createElement('input');
                    inputQuantity.setAttribute('type', 'hidden');
                    inputQuantity.setAttribute('name', 'quantity');
                    inputQuantity.setAttribute('value', '1');
                    inputQuantity.setAttribute('min', '1');
                    form.appendChild(inputQuantity);

                    const cardInfo = document.createElement('div');
                    cardInfo.classList.add('CardInfo');
                    cardInfo.setAttribute('type', 'submit'); // Set the type attribute to "submit"
                    cardInfo.innerHTML = `
                            <h1>${product.product_name}</h1>
                            <p>${product.descripcion}</p>
                            <p>$${product.precio}</p>
                            <button class="add-button" type="submit">Add To Cart</button>
                    </div>
                    `;

                    form.appendChild(cardInfo);
                    card.appendChild(cardImg);
                    card.appendChild(form);
                    return card;
                }

                function createCartCard(cartItem) {
                    const item = document.createElement('div');
                    item.classList.add('item');

                    const divImage = document.createElement('div');
                    divImage.classList.add('image');
                    item.appendChild(divImage);

                    divImage.innerHTML = `
                        <img src="${cartItem.img}" alt="">
                    `;

                    const divName = document.createElement('div');
                    divName.classList.add('name');
                    divName.innerHTML = `
                        ${cartItem.product_name}
                    `;

                    item.appendChild(divName);

                    const divPrice = document.createElement('div');
                    divPrice.classList.add('totalPrice');
                    divPrice.innerHTML = `
                        $${cartItem.precio * cartItem.cantidad}
                    `;

                    item.appendChild(divPrice);


                    const divQuantity = document.createElement('div');
                    divQuantity.classList.add('quantity');
                    item.appendChild(divQuantity);

                    divQuantity.innerHTML = `
                        <form method="POST" action="delete_from_cart.php">
                            <input class="minus" type="hidden" name="quantity" value="${cartItem.cantidad}"></input>
                            <input class="minus" type="hidden" name="product_id" value="${cartItem.idProducto}"></input>
                                
                            <button type="submit">
                                <i class="fa-solid fa-minus" style="color: #131b29;"></i>
                            </button>
                        </form>

                        <span>${cartItem.cantidad}</span>

                        <form method="POST" action="sum_to_cart.php">
                            <input class="plus" type="hidden" name="quantity" value="${cartItem.cantidad}"></input>
                            <input class="plus" type="hidden" name="product_id" value="${cartItem.idProducto}"></input>
                               
                            <button type="submit">
                                <i class="fa-solid fa-plus" style="color: #131b29;"></i>
                            </button>
                        </form>
                    `;

                    return item;
                }

                document.addEventListener('DOMContentLoaded', () => {
                    // Show Cart
                    let iconCart = document.querySelector('.icon-cart');
                    let closeCart = document.querySelector('.close');
                    let body = document.getElementById('Container');

                    iconCart.addEventListener('click', () => {
                        console.log('pressing-shopping-cart');
                        body.classList.toggle('showCart');
                    })

                    // Close Cart
                    closeCart.addEventListener('click', () => {
                        console.log('pressing-close-button');
                        body.classList.toggle('showCart');
                    })
                });
            </script>
        </div>
        <div class="cartTab">
            <h1>Shopping Cart</h1>
            <div class="listCart" id="listCart">
            </div>
            <div class="btn">
                <button class="close">CLOSE</button>
                <form action="Server/tickets.php" method="POST">
                    <button class="checkOut">CHECK OUT</button>
                </form>
            </div>
        </div>
    </div>
</body>
<footer class="foot">
    <h1>Oscar Alejandro Macias Castillo</h1>
    <h1>4P</h1>
    <h1>Desarrollo Web y Bases de Datos I</h1>
</footer>

</html>