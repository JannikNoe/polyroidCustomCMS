<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\Post;

// ruft die Seite Userübersicht auf.
class UserListController extends BaseController{
    public function index() {
        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/login');
        }

        $this->user->find($this->user->getId());

        $this->view->render('userlist/index', [

        ]);
    }

}