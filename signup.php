<?php
require_once "includes/config_session.inc.php";
require_once "includes/signup_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Sign Up</title>
</head>

<body>

    <div class="signup-card">

        <div class="card-logo">
            <img src="css/tempLogo.jpg" alt="logo">
        </div>

        <h1>Create Account</h1>

        <p class="subtext">
            Already have an account?
            <a href="login.php">Sign in</a>
        </p>

        <?php checkSignupErrors(); ?>

        <form class="signup-form"
            action="<?php echo htmlspecialchars('includes/signup_process.php'); ?>"
            method="POST">

            <?php signupInput(); ?>

            <button class="signup-btn">Sign up</button>
        </form>

    </div>

</body>

</html>