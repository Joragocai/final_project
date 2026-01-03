<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'login_model.inc.php';
require_once 'login_contr.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';

$errors = [];

if (isInputEmpty($username, $pwd)) {
    $errors['emptyInput'] = 'Username and password are required.';
}

$user = getUser($pdo, $username);
$hashed = $user['pwd'] ?? null;

if (!$user) {
    $errors['wrongUsername'] = 'Invalid credentials.';
}

if (empty($errors)) {
   
    if ($hashed === null || isPasswordWrong($pwd, $hashed)) {
        $errors['wrongPassword'] = 'Invalid credentials.';
    }
}

if (!empty($errors)) {
    $_SESSION['errorsLogin'] = $errors;
    header('Location: ../login.php');
    exit;
}

session_regenerate_id(true);
$userId = $user['id'] ?? null;
$userName = $user['username'] ?? $username;

$_SESSION['user_id'] = $userId;
$_SESSION['user_username'] = $userName;

header('Location: ../dashboard.php');
exit;
