<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/auth_check.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/profile_current_time.inc.php';

$user_id = $_SESSION['user_id'];
$user = getUserProfile($pdo, $user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
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
            <a href="newborn_clothing.php">Newborn</a>
        </nav>

        <div class="nav-right">
            <a href="wishlist.php"><i class="fa-regular fa-heart"></i></a>
            <a href="profile.php"><i class="fa-regular fa-user"></i></a>
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>


    <div class="profile-container">

        <section class="profile-content">

            <h1>Profile Information</h1>

            <div class="info-grid">

                <div class="info-item">
                    <label>Full Name</label>
                    <p><?php echo htmlspecialchars($user['username']); ?></p>
                </div>

                <div class="info-item">
                    <label>Email</label>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <div class="info-item">
                    <label>Date Joined</label>
                    <p><?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
                </div>

            </div>

            <a href="includes/logout.inc.php" class="logout">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>

        </section>

    </div>

</body>

</html>