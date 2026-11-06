<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/icons/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sabrina Carpenter - Cart</title>
</head>
<body>
    <main class="cart-wish-feed bordr rounded-md shadow-md">
        <header>
            <h2>Lista de Deseados</h2>
        </header>

        <div class="cart-wish-layout">
            <aside class="sidebar" aria-label="Cart navigation">
                <button type="button">Carrito de Compras</button>
                <button type="button">Lista de Deseados</button>
            </aside>

            <section class="contenido-switch">
                <div id="carrito-mostrar">

                    <article class="carrito">
                        <figure class="producto-img">
                            <img src="src/articls/ceramic-tray.webp" alt="producto">
                        </figure>
                        <div class="info-producto">
                            <h2 class="font-bold">Product 1</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                            <span class="producto-price">$45</span>
                        </div>
                        <div class="article-options">
                            <button type="button" class="rounded-xs border p-3 block bg-red-300 hover:bg-amber-400">
                                Delete
                            </button>
                        </div>
                        
                    </article>

                    

                    

                </div>
                <div class="carrito-vacio " hidden>
                    <h5>Tu Carro de Compras esta vacio.</h5>
                    <p>Aun no tienes productos en tu carrito</p>
                    <figure class="carrito-svg" >    
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="64"
                            height="64"
                            viewBox="0 0 64 64"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            >
                            <!-- Carrito -->
                            <path d="M8 12h6l6 29h27l7-21H17" />
                            <path d="M20 41l-2 5a3 3 0 0 0 3 4h26" />


                            <circle cx="25" cy="55" r="2.5" />
                            <circle cx="45" cy="55" r="2.5" />


                            <circle cx="51" cy="12" r="9" fill="#fff" stroke="#ef4444" stroke-width="1.5"/>
                            <path d="M48.5 9.5l5 5m0-5l-5 5" stroke="#ef4444" stroke-width="1.8"/>
                        </svg>
                    </figure>

                    
                </div>

                <div id="lista-deseados">
                    
                </div>
            </section>
        </div>
        <section class="botones-cart">
            <a href="" id="boton-comprar"> <button class="button cart-action-button cart-checkout-button">Continuar al pago </button></a>
            <a href="shop.html"> <button class="button cart-action-button cart-back-button">Regresar</button> </a>
        </section>
        
    </main>
    <footer class="main-footer">
        <div class="social-network-div">
            <ul class="social-network">
                
                
            </ul>
        </div>
        <div class="disclaimer-footer">
            <p class="footer-copy text-shadow-lg/20">© 2026 Sabrina Carpenter Fan Concept. All rights reserved.</p>
            <p class="footer-copy text-shadow-lg/20">Fan-made concept website. Not affiliated with Sabrina Carpenter or her official team.</p>
        </div>
    </footer>
</body>
</html>
