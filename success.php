<?php
session_start();

$total = $_SESSION['checkout_total'] ?? 0;
$cash = $_SESSION['checkout_cash'] ?? 0;
$change = $_SESSION['checkout_change'] ?? 0;

unset($_SESSION['checkout_total']);
unset($_SESSION['checkout_cash']);
unset($_SESSION['checkout_change']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment Successful</title>
    <link rel="stylesheet" href="css/success.css">
</head>

<body>

    <h1>Checkout Complete!</h1>

    <p><strong>Total:</strong> ₱<?php echo number_format($total, 2); ?></p>
    <p><strong>Cash Given:</strong> ₱<?php echo number_format($cash, 2); ?></p>
    <p><strong>Your Change:</strong> ₱<?php echo number_format($change, 2); ?></p>

    <a href="dashboard.php">Return to Home</a>

</body>

</html>