<?php require_once 'header.php'; ?>

<main class="container">
    <form method="POST">
        <h3 class="form-title">Login</h3>
        <div class="input-wrapper">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="input-wrapper">
            <label for="pwd">password</label>
            <input type="password" name="pwd" id="pwd">
        </div>

        <button class="btn" type="submit">sign in</button>
        <p>Doesn't have an account? <a href="/register">sign up</a></p>
    </form>
</main>

<?php require_once 'footer.php'; ?>