<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$id = $_GET['id'] ?? 0;
$stmt = $mysqli->prepare('SELECT name, category_id FROM products WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
if (!$product) {
    die('Product not found');
}

$name = $product['name'];
$category_id = $product['category_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $stmt = $mysqli->prepare('UPDATE products SET name=?, category_id=? WHERE id=?');
    $stmt->bind_param('sii', $name, $category_id, $id);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error updating product';
    }
}

$categories = $mysqli->query('SELECT id, name FROM categories');
include __DIR__ . '/../includes/header.php';
?>
<h2>Edit Product</h2>
<?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
    <select name="category_id" required>
        <?php while ($c = $categories->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $category_id ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
        <?php endwhile; ?>
    </select>
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
