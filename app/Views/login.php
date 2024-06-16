<?php include __DIR__ . '/partials/header.php'; ?>

<form method="post" action="/login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>

    <?php if (isset($error)) : ?>
        <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
</form>

<?php include __DIR__ . '/partials/footer.php'; ?>