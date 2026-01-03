<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
require_once 'includes/dbh.inc.php';

$product_images = [
    1  => "css/images/boysshorts.jpg",
    8  => "css/images/boyshoodie.jpg",
    9  => "css/images/boyssocks.jpg",
    10 => "css/images/boysshoes.jpg",
    11 => "css/images/boysshirt.jpg",
    12 => "css/images/boyssweatshirt.jpg",
    19 => "css/images/boysbracelet.jpg",
    20 => "css/images/boysglasses.jpg",

    13 => "css/images/girlsshirt.jpg",
    14 => "css/images/girlssocks.jpg",
    15 => "css/images/girlssandals.jpg",
    16 => "css/images/girlsdress.jpg",
    17 => "css/images/girlshairband.jpg",
    18 => "css/images/girlsnecklace.jpg",
    21 => "css/images/girlsbracelet.jpg",
    22 => "css/images/girlsglasses.webp",

    2  => "css/images/babyshirt.jpg",
    3  => "css/images/babypants.jpg",
    4  => "css/images/babyjacket.jpg",
    5  => "css/images/babyhat.jpg",
    6  => "css/images/babymittens.jpg",
    7  => "css/images/babyblanket.jpg",
    23 => "css/images/babysocks.jpg",
    24 => "css/images/babysweatshirt.jpg",

    25 => "css/images/toddlerglasses.jpg",
    26 => "css/images/toddlergloves.jpg",
    27 => "css/images/toddlerhoodie.jpg",
    28 => "css/images/toddlerpants.jpg",
    29 => "css/images/toddlershirt.jpg",
    30 => "css/images/toddlershoes.jpg",
    31 => "css/images/toddlerslippers.jpg",
    32 => "css/images/toddlersocks.jpg",
];

$user_id = $_SESSION['user_id'];

$sql = "SELECT wishlist.id AS wish_id, products.*
        FROM wishlist
        JOIN products ON wishlist.product_id = products.id
        WHERE wishlist.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Wishlist</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/wishlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
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

    <main>
        <h1>Your Wishlist</h1>

        <div class="wishlist-container">

            <?php if (empty($items)): ?>
                <p class="empty">Your wishlist is empty.</p>

            <?php else: ?>

                <?php foreach ($items as $item): ?>
                    <div class="wishlist-card">

                        <?php
                        $img = $product_images[$item['id']] ?? "css/default.jpg";
                        ?>

                        <img src="<?php echo $img; ?>" class="product-img">

                        <h3><?php echo htmlspecialchars($item['product_name']); ?></h3>
                        <p>Size: <?php echo $item['size']; ?></p>
                        <p>Price: ₱<?php echo number_format($item['price'], 2); ?></p>

                        <div class="wish-actions">
                            <a href="includes/add_to_cart.inc.php?id=<?php echo $item['id']; ?>" class="cart-btn">Add to Cart</a>
                            <a href="includes/remove_wishlist.inc.php?id=<?php echo $item['wish_id']; ?>" class="remove-btn">Remove</a>
                        </div>

                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </main>

</body>

</html>