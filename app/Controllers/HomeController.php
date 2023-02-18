<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\Database;
use App\Models\Post;
use App\Models\User;

class HomeController extends BaseController {

    public function index() {

        $post = new Post($this->db);
        $posts = $post->findLatest();

        $this->view->render('home/index', [
            'posts' => $posts
        ]);

    }
}

