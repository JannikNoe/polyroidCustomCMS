<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/src/styles/app.css">
        <link rel="stylesheet" href="/src/styles/main.css">
        <link rel="stylesheet" href="/src/styles/grid.css">
        <link rel="stylesheet" href="/src/styles/reset.css">
        <link rel="stylesheet" href="/src/styles/header.css">
        <link rel="stylesheet" href="/src/styles/fonts.css">
        <link rel="stylesheet" href="/src/styles/dashboard.css">
        <title>Polyroid</title>
        <style>

        </style>
    </head>
    <body>
        <div class="content-1400" ">
<!--            <header>-->
<!--                <div class="header-wrapper">-->
<!--                    <h3>Janniks CMS System</h3>-->
<!--                    <nav>-->
<!--                        <ul>-->
<!--                            <li><a href="/dashboard">Dashboard</a></li>-->
<!--                            <li><a href="/profile">Profil</a></li>-->
<!--                            --><?php //if ($user->isLoggedIn()): ?>
<!--                                <li><a href="/posts/create">Post erstellen</a></li>-->
<!--                                <li><a href="/logout">Ausloggen</a></li>-->
<!--                            --><?php //else: ?>
<!--                                <li><a href="/register">Registrieren</a></li>-->
<!--                                <li><a href="/login">Anmelden</a></li>-->
<!--                            --><?php //endif; ?>
<!--                        </ul>-->
<!--                    </nav>-->
<!--                </div>-->
<!--            </header>-->
            <div class="menumobile flex">
                <h2>Blogmanager</h2>
                <img src="/src/images/icons/menu_FILL0_wght400_GRAD0_opsz48.svg">
            </div>
            <div class="grid-12">
                <div class="col-sp-0 col-sd-2 row-sp-12">
                    <div class="sidemenuDesktop">
                        <h2>Blogmanager</h2>
                        <nav class="flex navMenu">
                            <div class="flex navPoint navPointActive">
                                <img src="/src/images/icons/monitoring_FILL0_wght400_GRAD0_opsz48.svg" />
                                <h6>Dashboard</h6>
                            </div>
                            <div class="flex navPoint">
                                <img src="/src/images/icons/monitoring_FILL0_wght400_GRAD0_opsz48.svg" />
                                <h6>Posts Übersicht</h6>
                            </div>
                            <div class="flex navPoint">
                                <img src="/src/images/icons/monitoring_FILL0_wght400_GRAD0_opsz48.svg" />
                                <h6>Nutzer</h6>
                            </div>
                            <div class="flex navPoint">
                                <img src="/src/images/icons/monitoring_FILL0_wght400_GRAD0_opsz48.svg" />
                                <h6>Settings</h6>
                            </div>
                        </nav>
                        <button class="button button-logout"><img src="/src/images/icons/monitoring_FILL0_wght400_GRAD0_opsz48.svg"><h6>Logout</h6></button>
                    </div>
                </div>
                <div class="col-sp-12 col-sd-0 row-sp-12 menumobile">

                </div>



                <div class="messages">
                    <?php echo $session::flash('success'); ?>
                </div>

                <div class="messages error">
                    <?php echo $session::flash('error'); ?>
                </div>