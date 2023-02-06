<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\FormValidation;
use App\Models\User;
use App\Request;
use Exception;
use App\Models\Post;

class PostsController extends BaseController {
    public function index() {

    }

    public function create(Request $request) {
        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/');
        }

        if ($request->getMethod() === 'GET') {
            $this->view->render('posts/create');
        }


        $formInput = $request->getInput();


        $formValidation = new FormValidation($formInput, $this->db);

        $formValidation->setRules([
           'title' => 'required|min:10|max:64',
            'body' => 'required|min:100'
        ]);

        $formValidation->validate();

        if ($formValidation->fails()) {

            $this->view->render('posts/create', [

            ]);
        }

        try {
            $post = new Post($this->db);

            $post->create($this->user->getId(),
                $formInput['title'],
                $formInput['body']
            );

            Session::flash('success', 'Your Post has been created');
            $this->redirectTo('/dashboard');
        } catch (Exception $e) {

        }
    }
}
