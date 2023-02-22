<div class="col-sp-12 col-sd-10 row-sp-12">
    <video autoplay muted loop id="myVideo">
        <source src="/src/videos/alpacaVideo.mp4" type="video/mp4">
    </video>
    <div class="content-1200">
        <div class="login-wrapper">

            <h2>Blog Manager</h2>
            <form action="" method="post">
                <h3>Register</h3>
                <div class="inputLogin flex">
                    <label for="email">E-Mail-Adresse</label>
                    <input type="text" name="email" id="email" placeholder="Your E-Mail"/>


                    <?php if (isset($errors['email'])):?>
                        <div class="error"><?= $errors['email'][0] ?></div>
                    <?php endif;?>

                </div>

                <div class="inputLogin flex">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Your Username"/>


                    <?php if (isset($errors['username'])):?>
                        <div class="error"><?= $errors['username'][0] ?></div>
                    <?php endif;?>

                </div>

                <div class="inputLogin flex">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Your Password"/>

                    <?php if (isset($errors['password'])):?>
                        <div class="error"><?= $errors['password'][0] ?></div>
                    <?php endif;?>
                </div>

                <div class="inputLogin flex">
                    <label for="password-again">Password Wiederholen</label>
                    <input type="password" name="passwordAgain" id="password-again" placeholder="Your Password"/>

                    <?php if (isset($errors['passwordAgain'])):?>
                        <div class="error"><?= $errors['passwordAgain'][0] ?></div>
                    <?php endif;?>
                </div>

                <input type="submit" class="button loginButton" placeholder="Registrieren"/>
                <br />
                <a style="display: inline-block; margin-top: 14px; color: black; text-decoration: unset;" href="/login">Login</a>
            </form>
        </div>

    </div>
</div>


<?php

$data = [];

$data[] = 'text';

//
//
//<form action="index.php/?url=register" method="post">
//    <div class="">
//        <label for="email">E-Mail</label>
//        <input type="text" name="email" id="email" placeholder="Your E-Mail"/>
//    </div>
//    <div class="">
//        <label for="username">Username</label>
//        <input type="text" name="username" id="username" placeholder="Your Username"/>
//    </div>
//    <div class="">
//        <label for="password">Password</label>
//        <input type="password" name="password" id="password" placeholder="Your Password"/>
//    </div>
//
//    <div class="">
//        <label for="password-again">Password Wiederholen</label>
//        <input type="password" name="passwordAgain" id="password-again" placeholder="Your Password"/>
//    </div>
//
//    <input type="submit" />
//</form>



