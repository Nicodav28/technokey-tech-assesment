    <link rel="stylesheet" href="css/login.css">


    <div class="form-container">
        <form method="post" action="/login" class="login-form">
            <h2>Login</h2>

            <div class="form-group">
                <label for="email">email:</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>

            <?php if (isset($error)) : ?>
                <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </form>

        <div class="register-container">
            <h2>Register</h2>
            <p>Don't have an account? Register now!</p>
            <a href="/register" class="register-link">Register</a>
        </div>
    </div>