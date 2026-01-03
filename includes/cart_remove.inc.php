<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

$cart_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM cart WHERE id = ?");
$stmt->execute([$cart_id]);

header("Location: ..//cart.php");
exit();
