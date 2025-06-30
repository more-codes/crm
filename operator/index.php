<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('operator');
include __DIR__ . '/../includes/header.php';
?>
<h2>Operator Dashboard</h2>
<ul>
    <li><a href="/products/">View Products</a></li>
</ul>
<?php include __DIR__ . '/../includes/footer.php'; ?>
