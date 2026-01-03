<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../dashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_GET['id']);

$return_to_raw = $_GET['from'] ?? '../dashboard.php';
$return_to_raw = urldecode($return_to_raw);
$return_to_raw = str_replace(["\r", "\n"], '', $return_to_raw);

$parsed = parse_url($return_to_raw);

if ($parsed === false) {
    $final_path = '../dashboard.php';
} else {
    $path = $parsed['path'] ?? $return_to_raw;
    $query = [];
    if (!empty($parsed['query'])) {
        parse_str($parsed['query'], $query);
    }
    unset($query['wishlist'], $query['added']);

    $query['wishlist'] = '1';
    $new_query = http_build_query($query);
    $final_path = $path . ($new_query ? '?' . $new_query : '');

    if (!empty($parsed['host'])) {
        $host = $parsed['host'];
        $myHost = $_SERVER['HTTP_HOST'] ?? '';
        if (strcasecmp($host, $myHost) !== 0) {
            $final_path = '../dashboard.php?wishlist=1';
        }
    }
}

$stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ? LIMIT 1");
$stmt->execute([$user_id, $product_id]);

if (!$stmt->fetch()) {
    $insert = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $insert->execute([$user_id, $product_id]);
} 

header("Location: $final_path");
exit();
