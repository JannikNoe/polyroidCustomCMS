<div class="col-sp-12 col-sd-10 row-sp-12">
    <div class="content-1200">
        <div class="settingsWrapper">
            <div class="headline-wrapper flex">
                <h2>Einstellungen</h2>
            </div>

            <div class="col-sp-12 col-sd-12 row-sp-12">
                <div class="settings-headline-wrapper">
                    <div class="headline flex">
                        <img src="/src/images/icons/person_FILL1_wght400_GRAD0_opsz48.svg" alt="Person Icon" />
                        <h3>Account</h3>
                    </div>
                    <a href="#"><button class="button">Bearbeiten</button></a>
                </div>
                <div class="profile-wrapper flex">
                    <div class="profile">
                        <img src="/src/images/memes/memeoldlady.jpeg" alt="Placeholder" />
                    </div>
                    <div class="profileInformations">
                        <div class="distance"></div>
                        <div class="username">
                            <h6>Username</h6>
                            <p><?=$user->getUsername()?></p>
                        </div>
                        <hr/>
                        <div class="E-Mail-Adresse">
                            <h6>E-Mail-Adresse</h6>
                            <p><?=$user->getEmail()?></p>
                        </div>
                        <hr/>
                        <div class="E-Mail-Adresse">
                            <h6>Profilbild</h6>
                            <a href="#"><button class="button">Bild hochladen</button></a>
                        </div>
                    </div>
                </div>
                <div class="settings-general-wrapper">
                    <div class="headline flex">
                        <img src="/src/images/icons/settings_FILL1_wght400_GRAD0_opsz48.svg" alt="Person Icon" />
                        <h3>Allgemein</h3>
                    </div>
                    <div class="generalList">
                        <ul>
                            <a href="#"><li>Benachrichtigungscenter</li></a>
                            <a href="#"><li>Privatsphäre</li></a>
                            <a href="#"><li>Informationen</li></a>
                            <a href="#"><li>Info</li></a>
                            <a href="#"><li>Hilfecenter</li></a>
                            <a href="#"><li>Support Kontaktieren</li></a>
                        </ul>
                    </div>
                    <div class="buttons-wrapper flex">
                        <a href="#"><button class="button">Speichern</button></a>
                        <a class="delete" href="#">Account löschen</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>