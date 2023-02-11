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
            Session::flash('error', 'The page you were trying to acces does not exists');
            $this->redirectTo('/');

        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if (!$post->find($id)) {
            Session::flash('error', 'This Post could not be found');
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
           'title' => 'required|min:10|max:64',
            'body' => 'required|min:100'
        ]);

        $formValidation->validate();

        $fileInput = $request->getInput('file');
        $fileValidation = new FileValidation($fileInput);

        $fileValidation->setRules([

            'image' => 'type:image|maxsize:2097152'

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

            Session::flash('success', 'Your post has been created');
            $this->redirectTo('/dashboard');
        } catch (Exception $e) {
            echo 'Nix ists';
            d($e);

        }
    }

    public function delete(Request $request) {
        if (!isset($request->getInput( 'page' )[0])) {
            Session::flash('error', 'Tage page you were trying to acces dies not exists');
            $this->redirectTo('/dashboard');
        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if(!$post->find($id)) {
            Session::flash('error', 'This post has already been deleted');
            $this->redirectTo('/dashboard');
        }

        if (!$this->user->isLoggedIn() || $this->user->getId() !== $post->getUserId()) {
            Session::flash('error', 'You do not have permission to delete this post.');
            $this->redirectTo('/dashboard');
        }

        if (!$post->delete()) {
            Session::flash('error', 'Something went wrong.');
            $this->redirectTo('/dashboard');
        }

        Session::flash('success', 'The post was successfully deleted');
        $this->redirectTo('/dashboard');
    }
}
