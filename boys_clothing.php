<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
require_once 'includes/dbh.inc.php';

if (isset($_GET['wishlist'])) {
    $cleanUrl = strtok($_SERVER["REQUEST_URI"], '?');
    header("Refresh: 1.5; URL=" . $cleanUrl);
}

$product_ids = [1, 8, 9, 10, 11, 12, 19, 20];

$product_images = [
    1 => "css/images/boysshorts.jpg",
    8 => "css/images/boyshoodie.jpg",
    9 => "css/images/boyssocks.jpg",
    10 => "css/images/boysshoes.jpg",
    11 => "css/images/boysshirt.jpg",
    12 => "css/images/boyssweatshirt.jpg",
    19 => "css/images/boysbracelet.jpg",
    20 => "css/images/boysglasses.jpg",
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
    <link rel="stylesheet" href="css/global.css">
    <title>Boys Clothing</title>
</head>

<body>

    <header class="top-nav">
        <div class="nav-left">
            <a href="dashboard.php"><img src="css/tempLogo.jpg" alt="Logo" class="nav-logo"></a>
        </div>

        <nav class="nav-center">
            <a href="dashboard.php">Home</a>
            <a href="boys_clothing.php" class="active">Boys</a>
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
        <div class="wish-message">Added to Wishlist</div>
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

                    <p class="info stock <?= $p['stock'] <= 0 ? 'out' : ''; ?>">
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