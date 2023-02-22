<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\Post;

// Ruft die Einstellungen auf. Innerhalb der Function wird geprüft, ob der User eingeloggt ist und zieht die Daten des Users aus der DB.
class SettingsController extends BaseController{
    public function index() {
        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/login');
        }

        $this->user->find($this->user->getId());

        $this->view->render('settings/index', [

        ]);
    }


}