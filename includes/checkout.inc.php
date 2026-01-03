<?php
require_once 'config_session.inc.php';
require_once 'auth_check.inc.php';
require_once 'dbh.inc.php';

if (!isset($_POST['cash']) || !isset($_POST['total'])) {
    header("Location: ../cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$cash = floatval($_POST['cash']);
$total = floatval($_POST['total']);

// Check if user has enough money
if ($cash < $total) {
    $_SESSION['checkout_error'] = "Insufficient funds. You entered ₱$cash but total is ₱$total.";
    header("Location: ../cart.php");
    exit();
}

$change = $cash - $total;

// Fetch items
$sql = "SELECT cart.id AS cart_id, cart.quantity, cart.product_id,
               products.stock
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($items)) {
    header("Location: ../cart.php?empty=1");
    exit();
}
foreach ($items as $item) {
    $new_stock = $item['stock'] - $item['quantity'];

    if ($new_stock < 0) {
        $_SESSION['checkout_error'] = "Not enough stock for one of your items.";
        header("Location: ../cart.php");
        exit();
    }

    $update = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
    $update->execute([$new_stock, $item['product_id']]);
}

$clear = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
$clear->execute([$user_id]);

$_SESSION['checkout_total'] = $total;
$_SESSION['checkout_cash'] = $cash;
$_SESSION['checkout_change'] = $change;

header("Location: ../success.php");
exit();
