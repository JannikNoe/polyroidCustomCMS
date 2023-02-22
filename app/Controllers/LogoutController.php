<?php

namespace App\Controllers;

use App\BaseController;
use App\Helpers\Session;
use App\Models\Database;
use App\Models\User;

// DB Verbindung wird hergestellt und logout Methode aufgerufen um den User auszuloggen.

class LogoutController extends BaseController {
    public function index() {

        $db = new Database();

        $user = new User($db);
        $user->logout();
        Session::flash('success', '<div class="flashbox flashboxSuccess">Du hast dich erfolgreich ausgeloggt.</div>');
        header('Location: /');
    }
}