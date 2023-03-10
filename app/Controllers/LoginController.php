<?php

namespace App\Controllers;

use App\Basecontroller;
use App\Helpers\Session;
use App\Models\FormValidation;
use App\Models\Database;
use App\Models\User;
use App\Request;
use Exception;


class LoginController extends BaseController {
    public function index( Request $request)
    {

        if($this->user->isLoggedIn()) {
            $this->redirectTo('/');
        }

        if ($request->getMethod() === 'GET') {
            $this->view->render('login/index');
            return;
        }


        // Post
        // Input Validieren
        $formInput = $request->getInput('post');
        $validation = new FormValidation($formInput, $this->db);

         $validation->setRules([
             'email' => 'required|email|min:3|max:64', // mail ausgeklammert
             'password' => 'required|min:6|max:64',
         ]);


         $validation->validate();

         if ($validation->fails()) {
             $this->view->render('login/index', [
                 'errors' => $validation->getErrors()
             ]);
         }


        // User Login
         try {
             $this->user->login($formInput['email'], $formInput['password']);
             Session::flash('success', 'Yuu have been successfully signed in.');
             $this->redirectTo('/dashboard');
         } catch (Exception $e){
             $this->view->render('login/index', [
                 'errors' => [
                     'root' => [$e->getMessage()]
                 ]
             ]);
         }

    }
}