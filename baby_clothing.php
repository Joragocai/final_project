<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
require_once 'includes/dbh.inc.php';

if (isset($_GET['added']) || isset($_GET['wishlist'])) {
    $clean = strtok($_SERVER["REQUEST_URI"], '?');
    header("Refresh: 1.5; URL=$clean");
}

$product_ids = [2, 3, 4, 5, 6, 7, 23, 24];
$product_images = [
    2 => "css/images/babyshirt.jpg",
    3 => "css/images/babypants.jpg",
    4 => "css/images/babyjacket.jpg",
    5 => "css/images/babyhat.jpg",
    6 => "css/images/babymittens.jpg",
    7 => "css/images/babyblanket.jpg",
    23 => "css/images/babysocks.jpg",
    24 => "css/images/babysweatshirt.jpg",
];

$placeholders = implode(',', array_fill(0, count($product_ids), '?'));
$stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->execute($product_ids);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
    <link rel="stylesheet" href="css/global.css">
    <title>Baby Clothing</title>
</head>

<body>

    <header class="top-nav">

        <div class="nav-left">
            <a href="dashboard.php"><img src="css/tempLogo.jpg" alt="Logo" class="nav-logo"></a>
        </div>

        <nav class="nav-center">
            <a href="dashboard.php">Home</a>
            <a href="boys_clothing.php">Boys</a>
            <a href="girls_clothing.php">Girls</a>
            <a href="baby_clothing.php">Baby</a>
            <a href="newborn_clothing.php">Toddler</a>
        </nav>

        <div class="nav-right">
            <a href="wishlist.php"><i class="fa-regular fa-heart"></i></a>
            <a href="profile.php"><i class="fa-regular fa-user"></i></a>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>

    <?php if (isset($_GET['added'])): ?>
        <div class="cart-message">Item added to cart!</div>
    <?php endif; ?>

    <?php if (isset($_GET['wishlist'])): ?>
        <div class="wish-message">Added to wishlist!</div>
    <?php endif; ?>

    <div class="page-content">
        <div class="product-container">

            <?php foreach ($products as $p): ?>
                <div class="product-card">

                    <a href="includes/add_to_wishlist.inc.php?id=<?= $p['id']; ?>&from=<?= urlencode($_SERVER['REQUEST_URI']); ?>"
                        class="wish-btn">
                        <i class="fa-regular fa-heart"></i>
                    </a>

                    <img src="<?= $product_images[$p['id']]; ?>" class="product-img">

                    <h3><?= htmlspecialchars($p['product_name']); ?></h3>

                    <p class="info"><strong>Size:</strong> <?= $p['size']; ?></p>
                    <p class="info"><strong>Price:</strong> ₱<?= number_format($p['price'], 2); ?></p>

                    <p class="info stock <?= ($p['stock'] <= 0 ? 'out' : '') ?>">
                        <strong>Stock:</strong> <?= $p['stock']; ?>
                    </p>

                    <a class="add-btn"
                        href="includes/add_to_cart.inc.php?id=<?= $p['id']; ?>&from=<?= urlencode($_SERVER['REQUEST_URI']); ?>">
                        Add to Cart
                    </a>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
</body>

</html>