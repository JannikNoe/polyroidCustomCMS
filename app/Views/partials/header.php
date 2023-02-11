<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/styles/app.css">
        <title>Polyroid</title>
        <style>
            .header-wrapper{
                display: flex;
                align-items: baseline;
            }

            .header-wrapper ul li {
                display: inline;
                margin: 0 8px;
            }

            .header-wrapper a{
                color: black;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="content-1400" style="max-width: 1400px; margin: 0 auto;">
            <header>
                <div class="header-wrapper">
                    <h3>Janniks CMS System</h3>
                    <nav>
                        <ul>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/profile">Profil</a></li>
                            <?php if ($user->isLoggedIn()): ?>
                                <li><a href="/posts/create">Post erstellen</a></li>
                                <li><a href="/logout">Ausloggen</a></li>
                            <?php else: ?>
                                <li><a href="/register">Registrieren</a></li>
                                <li><a href="/login">Anmelden</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </header>

            <div class="messages">
                <?php echo $session::flash('success'); ?>
            </div>

            <div class="messages error">
                <?php echo $session::flash('error'); ?>
            </div>