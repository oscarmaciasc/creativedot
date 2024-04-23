<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="producto.css">
    <link rel="stylesheet" href="normalize.css">
    <title>Product</title>
</head>
<header class="HeadFlex">
    <div class="HeadLogo">
        <h1>creative.dot</h1>
    </div>
    <div class="HeadNav">
        <ul>
            <a href="index.html">HOME</a>
            <a href="productos.php">STORE</a>
            <a href="artistas.html">ARTISTS</a>
            <a href="#">ABOUT US</a>
        </ul>
    </div>
    <div class="HeadHamburguer">
        <i class="fa-solid fa-bars"></i>
    </div>
</header>

<body>
    <script>
        const container = document.createElement('div');
        container.classList.add('container');

        const flexContent = document.createElement('div');
        flexContent.classList.add('flex-content');
        container.appendChild(flexContent);

        const flexBigImg = document.createElement('div');
        flexBigImg.classList.add('flex-big-img');
        flexContent.appendChild(flexBigImg);

        const bigImg = document.createElement('div');
        bigImg.classList.add('big-img');
        bigImg.setAttribute('id', 'bigImg');
        flexBigImg.appendChild(bigImg);

        const flexVariousImg = document.createElement('div');
        flexVariousImg.classList.add('flex-various-img');
        flexContent.appendChild(flexVariousImg);



        // Fetch product data from the server
        fetch('getProductImg.php'

                , {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: new URLSearchParams({
                        'idProducto': id.toString(),
                    }),
                })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log(response.json);
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                // Display product cards
                data.forEach(img => {
                    var n = 1;
                    const miniImg = createMiniImg(img, n);
                    flexVariousImg.appendChild(miniImg);
                    // flexVariousImg.innerHTML = `
                    //     <div class="mini-img" style="background-image:${img.img};"></div>
                    // `;
                    n++;
                });
            })
            .catch(error => console.error('Error fetching product data:', error));


        function createMiniImg(img, n) {
            const miniImg = document.createElement('div');
            miniImg.classList.add('mini-img');
            miniImg.setAttribute('id', 'image' + n);
            miniImg.setAttribute('backgroundImage', 'url(' + img.img + ')');
        }

        const changeImage = e => {
            console.log("Estoy haciendo algo")
            var bigImg = document.getElementById("bigImg");
            var idTarget = e.target.id;
            console.log(idTarget);
            var targetImg = document.getElementById(idTarget);
            bigImg.style.backgroundImage = targetImg.style.backgroundImage;
            console.log(bigImg.style.backgroundImage);
        }
    </script>


    <div class="container">
        <div class="flex-content">
            <div class="flex-big-img">
                <div class="big-img" id="bigImg"></div>
            </div>
            <div class="flex-various-img">
                <div class="mini-img" id="image1" style="background-image: url(img/00-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="mini-img" id="image2" style="background-image: url(img/01-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="mini-img" id="image4" style="background-image: url(img/02-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="mini-img" id="image5" style="background-image: url(img/03-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="mini-img" id="image6" style="background-image: url(img/00-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="mini-img" id="image7" style="background-image: url(img/01-Art.jpg);" onclick="changeImage(event)"></div>
                <div class="flex-info">
                    <div class="text-product"></div>
                    <form class="btn-product" action="Server/tickets.php" method="POST">
                        <button type="submit">Buy Now!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html> -->