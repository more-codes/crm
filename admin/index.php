<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');
include __DIR__ . '/../includes/header.php';
?>
<h2>Admin Dashboard</h2>
<ul>
    <li><a href="/products/">Manage Products</a></li>
    <li><a href="/operators/">Manage Operators</a></li>
    <li><a href="/categories/">Manage Categories</a></li>
</ul>
<?php include __DIR__ . '/../includes/footer.php'; ?>
