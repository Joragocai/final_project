<?php
require_once 'config_session.inc.php';
require_once 'auth_check.inc.php';
require_once 'dbh.inc.php';

if (!isset($_GET['id'])) {
    die("Product ID missing.");
}

$product_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
    $stmt->execute([$existing['id']]);
} else {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
    $stmt->execute([$user_id, $product_id]);
}


if (!empty($_GET['from'])) {
    $returnUrl = urldecode($_GET['from']);

    if (strpos($returnUrl, '?') !== false) {
        $returnUrl .= "&added=1";
    } else {
        $returnUrl .= "?added=1";
    }

    header("Location: " . $returnUrl);
    exit();
}

$redirect = isset($_GET['from']) ? $_GET['from'] : '../boys_clothing.php';
header("Location: " . $redirect . (strpos($redirect, '?') ? '&added=1' : '?added=1'));
exit();

