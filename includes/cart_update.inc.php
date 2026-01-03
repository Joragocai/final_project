<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

$cart_id = $_GET['id'];
$type = $_GET['type'];

if ($type == "plus") {
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE id = ?";
} else {
    $sql = "UPDATE cart SET quantity = quantity - 1 WHERE id = ? AND quantity > 1";
}

$stmt = $pdo->prepare($sql);
$stmt->execute([$cart_id]);

header("Location: ../cart.php");
exit();
