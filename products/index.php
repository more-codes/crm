<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
include __DIR__ . '/../includes/header.php';

$result = $mysqli->query('SELECT products.id, products.name, categories.name AS category FROM products LEFT JOIN categories ON products.category_id = categories.id');
?>
<h2>Products</h2>
<a href="create.php">Add Product</a>
<table border="1" cellpadding="5" cellspacing="0">
<tr><th>ID</th><th>Name</th><th>Category</th><th>Actions</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
