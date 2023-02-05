<?php

if (isset($data['errors'])) {
    foreach ($data['errors'] as $fieldErrors) {
        echo '<div>' . $fieldErrors[0] . '</div>';
    }
}

?>



<h1>Login</h1>
<form action="" method="post">
    <div class="">
        <label for="email">E-Mail</label>
        <input type="text" name="email" id="email" placeholder="Your E-Mail"/>
    </div>
    <div class="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your Password"/>
    </div>

    <input type="submit" />
</form>



