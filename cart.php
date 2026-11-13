<?php
declare(strict_types=1);

require_once __DIR__ . '/repositories/ProductRepository.php';
require_once __DIR__ . '/repositories/WishlistRepository.php';

session_start();

if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$cart = is_array($_SESSION['cart'] ?? null) ? $_SESSION['cart'] : [];
$cartError = '';
$isWishlistRequest = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist_action']);
$isWishlist = $isWishlistRequest || (($_GET['view'] ?? '') === 'wishlist' && $_SERVER['REQUEST_METHOD'] !== 'POST');
$viewName = $isWishlist ? 'Wishlist' : 'Cart';

if ($isWishlistRequest) {
    $csrfToken = $_POST['csrf_token'] ?? '';
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $cartError = 'Invalid request. Please try again.';
    } elseif ($_POST['wishlist_action'] !== 'remove' || !is_int($productId) || $productId < 1) {
        $cartError = 'Invalid wishlist action. Please try again.';
    } else {
        try {
            WishlistRepository::create()->remove((int) $_SESSION['user']['id'], $productId);
            header('Location: cart.php?view=wishlist', true, 303);
            exit;
        } catch (PDOException $exception) {
            error_log('Unable to remove wishlist item: ' . $exception->getMessage());
            $cartError = 'We could not update your wishlist. Please try again.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isWishlistRequest) {
    $csrfToken = $_POST['csrf_token'] ?? '';
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = is_string($_POST['cart_action'] ?? null) ? $_POST['cart_action'] : '';

    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $cartError = 'Invalid request. Please try again.';
    } elseif (!is_int($productId) || $productId < 1 || !isset($cart[$productId])) {
        $cartError = 'That item is no longer in your cart.';
    } elseif ($action === 'remove') {
        unset($cart[$productId]);
    } elseif ($action === 'increase' || $action === 'decrease') {
        try {
            $product = ProductRepository::create()->findPublicProductById($productId);
            if (!$product || (int) $product['stock'] < 1 || $product['estado_nombre'] === 'Agotado') {
                unset($cart[$productId]);
                $cartError = 'An unavailable product was removed from your cart.';
            } else {
                $quantity = (int) $cart[$productId];
                if ($action === 'increase') {
                    $cart[$productId] = min($quantity + 1, (int) $product['stock']);
                    if ($quantity >= (int) $product['stock']) {
                        $cartError = 'You have reached the available quantity for this product.';
                    }
                } elseif ($quantity <= 1) {
                    unset($cart[$productId]);
                } else {
                    $cart[$productId] = $quantity - 1;
                }
            }
        } catch (PDOException $exception) {
            error_log('Unable to update cart: ' . $exception->getMessage());
            $cartError = 'We could not update your cart. Please try again.';
        }
    }

    $_SESSION['cart'] = $cart;
    if ($cartError === '') {
        header('Location: cart.php');
        exit;
    }
}

$items = [];
$total = 0.0;
try {
    $productRepository = ProductRepository::create();
    $productsToLoad = $cart;
    if ($isWishlist) {
        $items = WishlistRepository::create()->findByUserId((int) $_SESSION['user']['id']);
        $productsToLoad = [];
    }
    foreach ($productsToLoad as $productId => $quantity) {
        $product = $productRepository->findPublicProductById((int) $productId);
        if (!$product || (int) $product['stock'] < 1 || $product['estado_nombre'] === 'Agotado') {
            unset($cart[$productId]);
            continue;
        }

        $quantity = max(1, min((int) $quantity, (int) $product['stock']));
        $cart[$productId] = $quantity;
        $product['quantity'] = $quantity;
        $items[] = $product;
        $total += (float) $product['precio'] * $quantity;
    }
    $_SESSION['cart'] = $cart;
} catch (PDOException $exception) {
    error_log('Unable to load cart: ' . $exception->getMessage());
    $cartError = $isWishlist
        ? 'We could not load your wishlist. Please try again later.'
        : 'We could not load your cart. Please try again later.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Playfair+Display:ital,wght@0,400..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="src/icons/favicon.webp" type="image/x-icon">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Sabrina Carpenter - <?= $viewName ?></title>
</head>
<body class="cart-page">
    <main class="cart-wish-feed bordr rounded-md shadow-md">
        <header>
            <h2 class="font-bold text-2xl antialiased md:subpixel-antialiased text-center ">Your Sweet Little <?= $viewName ?> </h2>
        </header>

        <?php if ($cartError !== ''): ?>
            <p class="my-3 rounded-md bg-red-100 p-3 text-sm text-red-700" role="alert">
                <?= htmlspecialchars($cartError, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <?php if (!$isWishlist && isset($_GET['added'])): ?>
            <p class="my-3 rounded-md bg-green-100 p-3 text-sm text-green-800" role="status">Product added to your cart.</p>
        <?php endif; ?>

        <form id="collection-navigation" method="get" action="cart.php"></form>
        <div class="cart-wish-layout">
            <aside class="sidebar" aria-label="Cart navigation">
                <button type="submit" form="collection-navigation" name="view" value="cart" class="bg-red-100 border-1 rounded-xs border-black-200 hover:bg-red-300" <?= !$isWishlist ? 'aria-current="page"' : '' ?>>Cart Shop</button>
                <button type="submit" form="collection-navigation" name="view" value="wishlist" class="bg-red-100 border-1 rounded-xs border-black-200 hover:bg-red-300" <?= $isWishlist ? 'aria-current="page"' : '' ?>>Wishlist</button>
            </aside>

            <section class="contenido-switch rounded-md" aria-label="<?= $isWishlist ? 'Wishlist items' : 'Shopping cart items' ?>">
                <?php if ($items === []): ?>
                    <div class="carrito-vacio">
                        <h5>Your <?= $viewName ?> is empty.</h5>
                        <p>You don't have any products in your <?= strtolower($viewName) ?> yet.</p>

                    </div>
                <?php else: ?>
                    <div id="carrito-mostrar">
                        <?php foreach ($items as $item): ?>
                            <article class="carrito-articulo grid grid-cols-4 gap-3 max-[490px]:grid-cols-2">
                                <figure class="producto-img col-span-1 max-[490px]:col-span-2">
                                    <?php if (!empty($item['imagen_front'])): ?>
                                        <img src="<?= htmlspecialchars((string) $item['imagen_front'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string) $item['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                                    <?php endif; ?>
                                </figure>
                                <div class="info-producto col-span-2">
                                    <h2 class="font-bold"><?= htmlspecialchars((string) $item['nombre'], ENT_QUOTES, 'UTF-8') ?></h2>
                                    <p><?= htmlspecialchars((string) $item['categoria_nombre'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php if ($isWishlist): ?>
                                        <?php $addedAt = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', (string) $item['fecha_agregado']); ?>
                                        <p>Added on:
                                            <?php if ($addedAt !== false): ?>
                                                <time datetime="<?= $addedAt->format('Y-m-d\TH:i:s') ?>"><?= $addedAt->format('d/m/Y H:i') ?></time>
                                            <?php else: ?>
                                                <?= htmlspecialchars((string) $item['fecha_agregado'], ENT_QUOTES, 'UTF-8') ?>
                                            <?php endif; ?>
                                        </p>
                                        <form method="post" action="cart.php?view=wishlist">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="product_id" value="<?= (int) $item['producto_id'] ?>">
                                            <button type="submit" name="wishlist_action" value="remove" class="delete-product-button rounded-md border p-3 block bg-red-300 hover:bg-red-400" aria-label="Remove <?= htmlspecialchars((string) $item['nombre'], ENT_QUOTES, 'UTF-8') ?> from wishlist" title="Remove from wishlist">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="10"/><path d="m15 9-6 6m0-6 6 6"/>
                                                </svg>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (!$isWishlist): ?>
                                    <div class="product-purchase-details">
                                        <div class="product-price-card">
                                            <span class="product-detail-label">Price</span>
                                            <strong class="producto-price">$<?= number_format((float) $item['precio'], 2, '.', ',') ?></strong>
                                        </div>
                                        <div class="quantity-control" aria-label="Quantity controls">
                                            <span class="product-detail-label">Quantity: <?= (int) $item['quantity'] ?></span>
                                            <div class="quantity-stepper">
                                                <?php foreach (['decrease' => '−', 'increase' => '+'] as $action => $label): ?>
                                                    <form method="post" action="cart.php">
                                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                                        <input type="hidden" name="product_id" value="<?= (int) $item['producto_id'] ?>">
                                                        <button type="submit" name="cart_action" value="<?= $action ?>" class="quantity-button" aria-label="<?= $action === 'increase' ? 'Increase' : 'Decrease' ?> quantity"><?= $label ?></button>
                                                    </form>
                                                <?php endforeach; ?>
                                                <form method="post" action="cart.php">
                                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <input type="hidden" name="product_id" value="<?= (int) $item['producto_id'] ?>">
                                                    <button type="submit" name="cart_action" value="remove" class="delete-product-button rounded-md border p-3 block bg-red-300 hover:bg-red-400" aria-label="Remove product">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <circle cx="12" cy="12" r="10"/><path d="m15 9-6 6m0-6 6 6"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <?php if (!$isWishlist): ?>
        <section class="mt-5 flex w-full flex-col items-end gap-3">
            <div class="flex w-full max-w-sm items-center justify-between gap-8 rounded-2xl border-2 border-rose-200 bg-rose-100 px-5 py-4 text-rose-950 shadow-lg sm:w-auto" aria-label="Cart total">
                <span class="text-base font-bold uppercase tracking-widest text-rose-900">Total</span>
                <strong class=" text-4xl leading-none">$<?= number_format($total, 2, '.', ',') ?></strong>
            </div>
            <div class="botones-cart mt-0 w-full flex-col items-stretch sm:w-auto sm:flex-row">
                <button class="button cart-action-button cart-checkout-button" type="button" <?= $items === [] ? 'disabled' : '' ?>>Proceed to Checkout</button>
                <a class="button cart-action-button cart-back-button" href="shop.php">Back to Shop</a>
            </div>
        </section>
        <?php endif; ?>
    </main>
</body>
</html>
