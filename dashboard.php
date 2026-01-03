<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
    <title>Dashboard</title>
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

    <section class="home-wrapper">

        <div class="home-block block-1">
            <div class="home-overlay"></div>
            <div class="home-text">
                <h1>Style & Comfort for Every Kid</h1>
                <p>"Fashion made for fun, confidence, and everyday adventures."</p>
                <a href="boys_clothing.php" class="home-btn">Shop Boys</a>
            </div>
        </div>

        <div class="quote-section">
            <p>"Dress them with love. Style them with personality."</p>
        </div>

        <div class="home-block block-2">
            <div class="home-overlay"></div>
            <div class="home-text">
                <h1>Trendy Looks for Girls</h1>
                <p>"Let their confidence shine with every outfit."</p>
                <a href="girls_clothing.php" class="home-btn">Shop Girls</a>
            </div>
        </div>

        <div class="quote-section">
            <p>"From playful to stylish — we have it all."</p>
        </div>

        <div class="home-block block-3">
            <div class="home-overlay"></div>
            <div class="home-text">
                <h1>Adorable Styles for Babies & Toddlers</h1>
                <p>"Soft, safe, and cozy — made for the little ones."</p>
                <a href="baby_clothing.php" class="home-btn">Shop Baby</a>
            </div>
        </div>

    </section>


</body>

</html>