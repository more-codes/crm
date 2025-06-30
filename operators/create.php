<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$username = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'operator')");
    $stmt->bind_param('ss', $username, $password);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error adding operator';
    }
}
include __DIR__ . '/../includes/header.php';
?>
<h2>Add Operator</h2>
<?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>
    <input type="password" name="password" required>
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
