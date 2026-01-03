<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

$wish_id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM wishlist WHERE id = ?");
$stmt->execute([$wish_id]);

header("Location: ../wishlist.php");
exit();
