<?php
require_once "includes/config_session.inc.php";
require_once "includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>

    <?php
    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }
    ?>

    <div class="signup-card">

        <div class="card-logo">
            <img src="css/tempLogo.jpg" alt="logo">
        </div>

        <h1>Login</h1>

        <p class="subtext">
            Don't have an account?
            <a href="signup.php">Sign up</a>
        </p>

        <?php checkLoginError(); ?>

        <form class="signup-form" action="<?php echo htmlspecialchars('includes/login_process.php'); ?>" method="POST">

            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">

            <button class="signup-btn">Sign in</button>

        </form>

    </div>

</body>



</html>