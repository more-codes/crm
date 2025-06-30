<?php
require_once __DIR__ . '/includes/auth.php';

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: /admin/');
        exit();
    } else {
        header('Location: /operator/');
        exit();
    }
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (login($_POST['username'], $_POST['password'])) {
        header('Location: /');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Login</h2>
<?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
