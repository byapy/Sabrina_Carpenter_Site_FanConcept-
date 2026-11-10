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
<body class="cart-page">
    <main class="cart-wish-feed bordr rounded-md shadow-md">
        <header>
            <h2>Cart</h2>
        </header>

        <div class="cart-wish-layout">
            <aside class="sidebar" aria-label="Cart navigation">
                <button type="button">Carrito de Compras</button>
                <button type="button">Lista de Deseados</button>
            </aside>

            <section class="contenido-switch">
                <div id="carrito-mostrar">

                    <article class="carrito-articulo grid grid-cols-4 gap-3 max-[490px]:grid-cols-2">
                        <figure class="producto-img col-span-1 max-[490px]:col-span-2">
                            <img src="src/articls/ceramic-tray.webp" alt="producto">
                        </figure>
                        <div class="info-producto col-span-2">
                            <h2 class="font-bold">Product 1</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                            <div class="product-purchase-details">
                                <div class="product-price-card">
                                    <span class="product-detail-label">Price</span>
                                    <strong class="producto-price">$45</strong>
                                </div>
                                <div class="quantity-control" aria-label="Cantidad del producto">
                                    <span class="product-detail-label">Quantity</span>
                                    <div class="quantity-stepper">
                                        <button type="button" class="quantity-button" aria-label="Disminuir cantidad" data-action="decrease">−</button>
                                        <output class="quantity-value">5</output>
                                        <button type="button" class="quantity-button" aria-label="Aumentar cantidad" data-action="increase">+</button>
                                        <button type="button" class="delete-product-button rounded-md border p-3 block bg-red-300 hover:bg-red-400" aria-label="Eliminar producto" data-action="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="m15 9-6 6m0-6 6 6"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="carrito-articulo grid grid-cols-4 gap-3 max-[490px]:grid-cols-2">
                        <figure class="producto-img col-span-1 max-[490px]:col-span-2">
                            <img src="src/articls/ceramic-tray.webp" alt="producto">
                        </figure>
                        <div class="info-producto col-span-2">
                            <h2 class="font-bold">Product 1</h2>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                            <div class="product-purchase-details">
                                <div class="product-price-card">
                                    <span class="product-detail-label">Price</span>
                                    <strong class="producto-price">$45</strong>
                                </div>
                                <div class="quantity-control" aria-label="Cantidad del producto">
                                    <span class="product-detail-label">Quantity</span>
                                    <div class="quantity-stepper">
                                        <button type="button" class="quantity-button" aria-label="Disminuir cantidad" data-action="decrease">−</button>
                                        <output class="quantity-value">5</output>
                                        <button type="button" class="quantity-button" aria-label="Aumentar cantidad" data-action="increase">+</button>
                                        <button type="button" class="delete-product-button rounded-md border p-3 block bg-red-300 hover:bg-red-400" aria-label="Eliminar producto" data-action="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="m15 9-6 6m0-6 6 6"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
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
        <section class="mt-5 flex w-full flex-col items-end gap-3">
            <div class="flex w-full max-w-sm items-center justify-between gap-8 rounded-2xl border-2 border-rose-400 bg-rose-100 px-5 py-4 text-rose-950 shadow-lg sm:w-auto" aria-label="Total del carrito">
                <span class="text-base font-bold uppercase tracking-widest text-rose-900">Total</span>
                <strong class="font-title text-4xl leading-none">$225.00</strong>
            </div>
            <div class="botones-cart mt-0 w-full flex-col items-stretch sm:w-auto sm:flex-row">
            <a href="" id="boton-comprar"> <button class="button cart-action-button cart-checkout-button">Pay </button></a>
            <a href="shop.php"> <button class="button cart-action-button cart-back-button">Back</button> </a>
            </div>
        </section>
        
    </main>
    <footer class="main-footer">
        <div class="social-network-div">
            <ul class="social-network">
                
                
            </ul>
        </div>
    </footer>
    
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.14.2/dist/Flip.min.js"></script>
<script src="js/store.js"></script>
</body>
</html>
