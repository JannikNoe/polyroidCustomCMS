<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Polyroid</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="/">Dashboard</a></li>
                    <li><a href="/profile">Profil</a></li>
                    <?php if ($user->isLoggedIn()): ?>
                        <li><a href="/post/create">Post erstellen</a></li>
                        <li><a href="/logout">Ausloggen</a></li>
                    <?php else: ?>
                        <li><a href="/register">Registrieren</a></li>
                        <li><a href="/login">Anmelden</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>

        <div class="messages">
            <?php echo $session::flash('success'); ?>
        </div>