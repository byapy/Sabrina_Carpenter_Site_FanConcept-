<?php
declare(strict_types=1);

require_once __DIR__ . '/repositories/ProductRepository.php';

session_start();

$currentUserName = is_string($_SESSION['user']['name'] ?? null) ? $_SESSION['user']['name'] : null;
$isAuthenticated = $currentUserName !== null;

// Puedes cambiar libremente los encabezados visibles de cada categoría aquí.
$categoryTitles = [
    1 => 'Exclusive Vinyl',
    2 => 'Amazing Clothes',
    3 => 'Beautiful Articles',
];

$catalog = [];
$catalogError = '';

try {
    foreach (ProductRepository::create()->findPublicCatalog() as $product) {
        $catalog[(int) $product['categoria_id']][] = $product;
    }
} catch (PDOException $exception) {
    error_log('No fue posible cargar el catálogo: ' . $exception->getMessage());
    $catalogError = 'No se pudo cargar el catálogo en este momento.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Playfair+Display:ital,wght@0,400..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/icons/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sabrina Carpenter - Store</title>
</head>
<body class="shop-body">
    <header class="shop-main-header">
        <?php include 'layouts/navbar.php'; ?>
        <div class="store-options-nav flex">
            <?php if ($isAuthenticated): ?>
                <a href="cart.php" id="carritoICON" class="top-button" aria-label="Shopping cart">
                    <svg class="user-head-options" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6.3 6h15.2l-1.7 8.4H8.1L6.3 6Z"></path><path d="M6.3 6 5.8 3.5H2.5"></path><path d="M9 18.5h.1"></path><path d="M18 18.5h.1"></path>
                    </svg>
                </a>
                <div class="account-controls">
                    <span class="flex h-9 border g-3 rounded-md  border-b-sky-50 bg-black/30" aria-label="Usuario autenticado">
                        <svg class="w-10 justify-self-center fill-current text-amber-50" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path></svg>
                        <span class=" p-1">
                            <?= htmlspecialchars($currentUserName, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                        
                    </span>
                    <a href="logout.php" class="rounded-md bg-black/30 h-9 flex border border-b-sky-50 ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-8  content-center">
                            <path d="M 52 20 H 78 C 82.4 20 86 23.6 86 28 V 72 C 86 76.4 82.4 80 78 80 H 52" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M 64 50 H 14 M 32 32 L 14 50 L 32 68" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            <?php else: ?>
                <a href="login.php" class="top-button" aria-label="Iniciar sesión">
                    <svg class="user-head-options" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4.5 21a7.5 7.5 0 0 1 15 0"></path></svg>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <main class="shop-main rounded-xl">
        <section class="shop-feed select-none">
            <?php if ($catalogError !== ''): ?>
                <p role="alert"><?= htmlspecialchars($catalogError, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <?php foreach ($catalog as $categoryId => $products): ?>
                <?php $categoryTitle = $categoryTitles[$categoryId] ?? $products[0]['categoria_nombre']; ?>
                <h2 class="shop-titles text-xl"><?= htmlspecialchars((string) $categoryTitle, ENT_QUOTES, 'UTF-8') ?></h2>
                <?php foreach ($products as $product): ?>
                    <?php
                    $isSoldOut = (int) $product['stock'] === 0 || $product['estado_nombre'] === 'Agotado';
                    $isPreOrder = $product['estado_nombre'] === 'Pre Venta';
                    $frontImage = (string) ($product['imagen_front'] ?? '');
                    $altImage = (string) ($product['imagen_alt'] ?? '');
                    $productName = (string) $product['nombre'];
                    ?>
                    <article class="shop-item">
                        <a href="ejemplo.html">
                            <figure class="item-figure">
                                <?php if ($isSoldOut): ?>
                                    <div class="stock-label"><h2 class="stock-label-text">Sold Out</h2></div>
                                <?php elseif ($isPreOrder): ?>
                                    <div class="limited-edic"><h2 class="limited-vers">Pre-order</h2></div>
                                <?php endif; ?>
                                <?php if ($altImage !== ''): ?>
                                    <img src="<?= htmlspecialchars($altImage, ENT_QUOTES, 'UTF-8') ?>" class="img-alt" alt="<?= htmlspecialchars($productName, ENT_QUOTES, 'UTF-8') ?>">
                                <?php endif; ?>
                                <?php if ($frontImage !== ''): ?>
                                    <img src="<?= htmlspecialchars($frontImage, ENT_QUOTES, 'UTF-8') ?>" class="img-normal" alt="<?= htmlspecialchars($productName, ENT_QUOTES, 'UTF-8') ?>">
                                <?php endif; ?>
                            </figure>
                        </a>
                        <div class="article-title"><h2><?= htmlspecialchars($productName, ENT_QUOTES, 'UTF-8') ?></h2></div>
                        <div class="price-box"><h2 class="prices">$<?= number_format((float) $product['precio'], 2, '.', ',') ?></h2></div>
                        <div class="product-actions">
                            <?php if (!$isAuthenticated && !$isSoldOut): ?>
                                <a href="login.php?form=register" class="shop-cart-button">Add to Cart</a>
                            <?php else: ?>
                                <button type="button" class="shop-cart-button<?= $isSoldOut ? ' sold-out-button' : '' ?>" <?= $isSoldOut ? 'disabled' : '' ?>>Add to Cart</button>
                            <?php endif; ?>
                            <a class="wishlist-button" href="cart.php" aria-label="View wishlist"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"></path></svg></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </section>
    </main>
    <?php include 'layouts/footer.php'; ?>
    <script src="js/navigation.js"></script>
    <script src="js/store.js"></script>
</body>
</html>
