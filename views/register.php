<?php require_once 'head.php' ?>

<main class="container">
    <form method="POST">
        <h3 class="form-title">Register</h3>
        <div class="input-wrapper">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="input-wrapper">
            <label for="pwd">password</label>
            <input type="password" name="pwd" id="pwd">
        </div>

        <button class="btn" type="submit">register</button>
        <p>Already has an account? <a href="/login">sign in</a></p>
    </form>
</main>

<?php require_once 'feet.php' ?>