<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$name = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $stmt = $mysqli->prepare('INSERT INTO categories (name) VALUES (?)');
    $stmt->bind_param('s', $name);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error adding category';
    }
}
include __DIR__ . '/../includes/header.php';
?>
<h2>Add Category</h2>
<?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
