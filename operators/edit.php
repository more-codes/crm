<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$id = $_GET['id'] ?? 0;
$stmt = $mysqli->prepare("SELECT username FROM users WHERE id=? AND role='operator'");
$stmt->bind_param('i', $id);
$stmt->execute();
$operator = $stmt->get_result()->fetch_assoc();
if (!$operator) {
    die('Operator not found');
}

$username = $operator['username'];
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $mysqli->prepare('UPDATE users SET username=?, password=? WHERE id=?');
        $stmt->bind_param('ssi', $username, $password, $id);
    } else {
        $stmt = $mysqli->prepare('UPDATE users SET username=? WHERE id=?');
        $stmt->bind_param('si', $username, $id);
    }
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error updating operator';
    }
}
include __DIR__ . '/../includes/header.php';
?>
<h2>Edit Operator</h2>
<?php if ($message): ?><p style="color:red;"> <?= $message ?> </p><?php endif; ?>
<form method="post">
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>
    <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
