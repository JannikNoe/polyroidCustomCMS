<?php

namespace App\Controllers;
use App\Basecontroller;

// Prüft, ob ein Benutzer angemeldet ist, lädt alle Posts des angemeldeten Benutzers und zeigt sie auf der Dashboard-Seite an.
class DashboardController extends BaseController {
    public function index() {

        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/login');

        }

        $this->user->find($this->user->getId());

        $posts = $this->user->getPosts();

        $this->view->render('dashboard/index', [
            'posts' => $posts
        ]);
    }




}