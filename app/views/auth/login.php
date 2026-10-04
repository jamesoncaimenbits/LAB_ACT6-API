<?php
/** @var array $product */
?>
<h2>Login</h2>
<?php if (isset($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>
<form method="post" action="<?= base_url('auth/login') ?>">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br> 
    <button type="submit">Login</button>
</form>