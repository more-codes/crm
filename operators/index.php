<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');
include __DIR__ . '/../includes/header.php';

$result = $mysqli->query("SELECT id, username FROM users WHERE role='operator'");
?>
<h2>Operators</h2>
<a href="create.php">Add Operator</a>
<table border="1" cellpadding="5" cellspacing="0">
<tr><th>ID</th><th>Username</th><th>Actions</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['username']) ?></td>
    <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></td>
</tr>
<?php endwhile; ?>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
