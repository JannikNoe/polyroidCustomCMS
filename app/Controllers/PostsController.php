<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\FormValidation;
use App\Models\User;
use App\Request;
use Exception;
use App\Models\Post;
use App\Models\FileValidation;
use App\Helpers\Session;


class PostsController extends BaseController {
    public function index(Request $request) {

        if (!isset($request->getInput('page')[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">The page you were trying to acces does not exists</div>');
            $this->redirectTo('/');

        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if (!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">This Post could not be found</div>');
            $this->redirectTo('/');
        }

        $this->view->render('posts/index', [
            'post' => $post
        ]);
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
           'title' => 'required|min:10|max:100',
            'body' => 'required|min:100'
        ]);

        $formValidation->validate();

        $fileInput = $request->getInput('file');
        $fileValidation = new FileValidation($fileInput);

        $fileValidation->setRules([

            'image' => 'required|type:image|maxsize:2097152'

        ]);

        $fileValidation->validate();

        if ($formValidation->fails() || $fileValidation->fails()){
            $this->view->render('posts/create', [
                'errors' => array_merge(
                    $formValidation->getErrors(),
                    $formValidation->getErrors()
                )
            ]);
        }

        try {
            $post = new Post($this->db);

            $image = isset($fileInput['image']) && $fileInput['image']['size'] > 0 ? $fileInput['image'] : null;

            $post->create(
                $this->user->getId(),
                $formInput['title'],
                $formInput['body'],
                $image
            );
            $successMessage = '<div class="flashbox flashboxSuccess">Der Beitrag wurde erfolreich erstellt</div>';
            $errorMessage = '<div class="flashbox flashboxError">Es ist etwas schiefgelaufen</div>';
            Session::flash('success', $successMessage);
            $this->redirectTo('/dashboard');
        } catch (Exception $e) {
            echo $errorMessage;
            d($e);

        }
    }

    public function delete(Request $request) {
        if (!isset($request->getInput( 'page' )[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">Tage page you were trying to acces dies not exists</div>');
            $this->redirectTo('/dashboard');
        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if(!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">This post has already been deleted</div>');
            $this->redirectTo('/dashboard');
        }

        if (!$this->user->isLoggedIn() || $this->user->getId() !== $post->getUserId()) {
            Session::flash('error', '<div class="flashbox flashboxError">You do not have permission to delete this post.</div>');
            $this->redirectTo('/dashboard');
        }

        if (!$post->delete()) {
            Session::flash('error', '<div class="flashbox flashboxError">Something went wrong.</div>');
            $this->redirectTo('/dashboard');
        }

        Session::flash('success', '<div class="flashbox flashboxSuccess">The post was successfully deleted</div>');
        $this->redirectTo('/dashboard');
    }

    public function edit(Request $request) {
        if (!isset($request->getInput('page')[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">You must access this page via link</div>');
            $this->redirectTo('/dashboard');
        }

        $id = $request->getInput('page')[0];
        $post = new Post($this->db);

        if(!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">This post does not exist</div>');
            $this->redirectTo('/dashboard', 404);
        }

        if (!$this->user->isLoggedIn() || $this->user->getId() !== $post->getUserId()) {
            Session::flash('error', '<div class="flashbox flashboxError">You do not have permission to edit this post.</div>');
            $this->redirectTo('/dashboard');
        }

        if ($request->getMethod() !== 'POST'){

            $this->view->render('/posts/edit', [
                'post' => $post
            ]);
        }


        $formInput = $request->getInput();

        $validation = new FormValidation($formInput, $this->db);


        $validation->setRules([
            'title' => 'required|min:10|max:64',
            'body' => 'required|min:100'
        ]);

        $validation->validate();

        if($validation->fails()) {
            $this->view->render('post/edit', [
                'errors' => $validation->getErrors()
            ], 422);
        }
    }
}
