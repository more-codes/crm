<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

$name = $category_id = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $stmt = $mysqli->prepare('INSERT INTO products (name, category_id) VALUES (?, ?)');
    $stmt->bind_param('si', $name, $category_id);
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $message = 'Error adding product';
    }
}

$categories = $mysqli->query('SELECT id, name FROM categories');
include __DIR__ . '/../includes/header.php';
?>
<h2>Add Product</h2>
<?php if ($message): ?><p style="color:red;"><?= $message ?></p><?php endif; ?>
<form method="post">
    <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($name) ?>" required>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while ($c = $categories->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $category_id ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
        <?php endwhile; ?>
    </select>
    <input type="submit" value="Save">
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
