<h1>Register</h1>

<?php

if (isset($errors)) {
    foreach ($errors as $fieldErrors) {
        echo '<div>' . $fieldErrors[0] . '</div>';
    }
}

?>

<form action="index.php/?url=register" method="post">
    <div class="">
        <label for="email">E-Mail</label>
        <input type="text" name="email" id="email" placeholder="Your E-Mail"/>
    </div>
    <div class="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Your Username"/>
    </div>
    <div class="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your Password"/>
    </div>

    <div class="">
        <label for="password-again">Password Wiederholen</label>
        <input type="password" name="passwordAgain" id="password-again" placeholder="Your Password"/>
    </div>

    <input type="submit" />
</form>



