<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
require_once 'includes/dbh.inc.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id AS cart_id, cart.quantity, 
               products.product_name, products.size, products.price
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
    <title>Cart</title>
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

    <h1 class="cart-title">Your Cart</h1>

    <?php if (isset($_SESSION['checkout_error'])): ?>
        <p class="error-msg">
            <?= $_SESSION['checkout_error'];
            unset($_SESSION['checkout_error']); ?>
        </p>
    <?php endif; ?>

    <div class="page-content">
        <div class="cart-container">

            <?php if (empty($cart_items)): ?>

                <p class="empty">Your cart is empty.</p>

            <?php else: ?>

                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">

                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['product_name']); ?></h3>
                            <p>Size: <?= $item['size']; ?></p>
                            <p>Price: ₱<?= number_format($item['price'], 2); ?></p>
                        </div>

                        <div class="item-qty">
                            <a class="qty-btn" href="includes/cart_update.inc.php?type=minus&id=<?= $item['cart_id']; ?>">-</a>
                            <span><?= $item['quantity']; ?></span>
                            <a class="qty-btn" href="includes/cart_update.inc.php?type=plus&id=<?= $item['cart_id']; ?>">+</a>
                        </div>

                        <div class="item-subtotal">
                            ₱<?= number_format($item['price'] * $item['quantity'], 2); ?>
                        </div>

                        <a class="remove-btn" href="includes/cart_remove.inc.php?id=<?= $item['cart_id']; ?>">
                            Remove
                        </a>

                    </div>
                <?php endforeach; ?>

                <div class="checkout-box">
                    <h2>Total: ₱<?= number_format($total, 2); ?></h2>

                    <form action="includes/checkout.inc.php" method="POST">
                        <div class="checkout-flex">
                            <label for="cash">Enter Payment Amount:</label>
                            <input type="number" id="cash" name="cash" step="0.01" required>

                            <input type="hidden" name="total" value="<?= $total; ?>">

                            <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>