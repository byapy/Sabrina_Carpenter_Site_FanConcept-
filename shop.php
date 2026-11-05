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
    <title>Sabrina Carpenter - Store</title>
</head>
<body class="shop-body">
    <header class="shop-main-header">
        <?php
            include 'layouts/navbar.php';
        ?>
        <div class="store-options-nav">
            <a href="cart.php"> <button id="carritoICON" type="button" class="top-button" aria-label="Shopping cart">
            <svg class="user-head-options" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M6.3 6h15.2l-1.7 8.4H8.1L6.3 6Z"></path>
                <path d="M6.3 6 5.8 3.5H2.5"></path>
                <path d="M9 18.5h.1"></path>
                <path d="M18 18.5h.1"></path>
            </svg>
            </button></a>
            
            <a href="cart.php">
            <button type="button" class="top-button" aria-label="Shopping cart">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="20"
                height="20"
                fill="pink">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            </button></a>

            <a href="login.php"> <button id="" type="button" class="top-button">
            <svg class="user-head-options" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path>
            </svg>
            </button></a>
        </div>
        
    </header>
    <main class="shop-main rounded-xl  ">
        
        <section class="shop-feed select-none overflow-auto  scrollbar-thin">
        <h2 class="shop-titles text-xl">Exclusive Vynil</h2>
            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="stock-label">
                            <h2 class="stock-label-text">Sold Out</h2>
                        </div>
                        <img src="src/vynil/Short_n_Sweet/SnSDeluxe.webp" class="img-alt" alt="main">
                        <img src="src/vynil/Short_n_Sweet/SNSD2C_Front02.webp" class="img-normal" alt="Front">
                    </figure>
                </a>
                <div class="article-title">
                    <h2>Short n' Sweet (Deluxe) </h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$39.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button sold-out-button" disabled>Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg>
                    </a>
                </div>
            </article>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="limited-edic">
                            <h2 class="limited-vers">Limited Edition</h2>
                        </div>
                        <img src="src/vynil/Mans_Best_Friend/MBF_01_recrop_BACK.webp" class="img-alt" alt="main">
                        <img src="src/vynil/Mans_Best_Friend/MBF_01_recrop_COVER.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Man's Best Friend  D2C Luxe Packaging </h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$45.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>
            

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="stock-label">
                            <h2 class="stock-label-text">Sold Out</h2>
                        </div>
                        <img src="src/vynil/Feather7/Feather_Front01.webp" class="img-alt" alt="main">
                        <img src="src/vynil/Feather7/Feather_Front02.webp" class="img-normal" alt="Front">
                    </figure>
                </a>
                <div class="article-title">
                    <h2>Feather 7" Vinyl</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$14.99</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button sold-out-button" disabled>Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg>
                    </a>
                </div>
            </article>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="stock-label">
                            <h2 class="stock-label-text">Sold Out</h2>
                        </div>
                        <img src="src/vynil/tears7/tears_front.webp" class="img-" alt="main">
                        <img src="src/vynil/tears7/tears_front01.webp" class="img-alt" alt="Front">
                    </figure>
                </a>
                <div class="article-title">
                    <h2>Tears 7in Single</h2>
                </div>

                <div class="price-box">
                    <h2 class="prices">$14.99</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button sold-out-button" disabled>Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg>
                    </a>
                </div>
            </article>


            <h2 class="shop-titles text-xl">Amazing Clothes</h2>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="stock-label">
                            <h2 class="stock-label-text">Sold Out</h2>
                        </div>
                        <img src="src/articls/plspls-zip.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Please Please Please Zip Hoodie</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$75.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button sold-out-button" disabled">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="stock-label">
                            <h2 class="stock-label-text">Sold Out</h2>
                        </div>
                        <img src="src/articls/GotYouBlocked_Front.webp" class=" img-normal" alt="Front">
                        <img src="src/articls/GotYouBlockedTee.webp" class="img-alt" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>got you blocked tee</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$40.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button sold-out-button" disabled">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <div class="limited-edic">
                            <h2 class="limited-vers">Limited Edition</h2>
                        </div>
                        <img src="src/articls/SNS_brown_baby_tee.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Short n' Sweet Tour Baby Tee</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$35.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>


            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <img src="src/articls/expresso-trucker-hat.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Espresso Embroidered Trucker Hat</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$30.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>
            
            <h2 class="shop-titles text-xl">Beatiful Articles</h2>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <img src="src/articls/puppy-keychain.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Man's Best Friend Puppy Keychain</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$22.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

            
            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <img src="src/articls/ceramic-tray.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Manchild Crushed Cigarette Box Ceramic Tray</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$30.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <img src="src/articls/piggy-bank.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Tour Camper Van Piggy Bank</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$25.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

            
            <article class="shop-item">
                <a href="ejemplo.html">
                    <figure class="item-figure">
                        <img src="src/articls/gogo_juice_zi.webp" class=" img-normal" alt="Front">
                    </figure>       
                </a>
                <div class="article-title">
                    <h2>Go Go Juice Flask Bag Charm</h2>
                </div>
                <div class="price-box">
                    <h2 class="prices">$30.00</h2>
                </div>
                <div class="product-actions">
                    <button type="button" class="shop-cart-button">Add to Cart</button>
                    <a class="wishlist-button" href="cart.html" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                </div>
            </article>

        </section>
    </main>
    <?php
        include 'layouts/footer.php';
    ?>
    
    <script src="js/navigation.js"></script>
    <script src="js/store.js"></script>
</body>
</html>
