<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Mini CRM</title>
</head>
<body>
<header>
    <h1>Mini CRM</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
    <nav>
        <a href="/">Home</a>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="/admin/">Admin Dashboard</a>
            <a href="/operators/">Operators</a>
        <?php else: ?>
            <a href="/operator/">Operator Dashboard</a>
        <?php endif; ?>
        <a href="/products/">Products</a>
        <a href="/categories/">Categories</a>
        <a href="/logout.php">Logout</a>
    </nav>
    <?php endif; ?>
</header>
<main>
