<?php
session_start();

require_once __DIR__ . '/db.php';

function login($username, $password) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT id, password, role FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            return true;
        }
    }
    return false;
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit();
    }
}

function require_role($role) {
    require_login();
    if ($_SESSION['role'] !== $role) {
        header('Location: /');
        exit();
    }
}
?>
