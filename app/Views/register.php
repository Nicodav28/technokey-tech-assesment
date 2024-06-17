    <link rel="stylesheet" href="css/register.css">



    <div class="form-container">
        <form method="post" action="/register" class="register-form">
            <h2>Register</h2>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Register</button>

            <?php if (isset($error)) : ?>
                <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </form>

        <div class="login-container">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>