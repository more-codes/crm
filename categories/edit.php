<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$id = $_GET['id'] ?? 0;
$stmt = $mysqli->prepare('SELECT name FROM categories WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$category = $stmt->get_result()->fetch_assoc();
if (!$category) {
    die('Category not found');
}

$name = $category['name'];
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $stmt = $mysqli->prepare('UPDATE categories SET name=? WHERE id=?');
    $stmt->bind_param('si', $name, $id);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error updating category';
    }
}
include __DIR__ . '/../includes/header.php';
?>
<h2>Edit Category</h2>
<?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
