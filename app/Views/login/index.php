
<h1>Login</h1>
<form action="" method="post">
    <div class="">
        <label for="email">E-Mail</label>
        <input type="text" name="email" id="email" placeholder="Your E-Mail"/>

        <?php if (isset($errors['email'])):?>
        <div class="error"><?= $errors['email'][0] ?></div>
        <?php endif;?>

    </div>
    <div class="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your Password"/>

        <?php if (isset($errors['password'])):?>
            <div class="error"><?= $errors['password'][0] ?></div>
        <?php endif;?>

    </div>

    <input type="submit" />
</form>

<?php

$data = [];

$data[] = 'text';



