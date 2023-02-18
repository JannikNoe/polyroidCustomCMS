<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\Post;


class SettingsController extends BaseController{
    public function index() {
        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/login');
            dd('Hallo');
        }

        $this->user->find($this->user->getId());

        $this->view->render('settings/index', [

        ]);
    }


}