<?php

namespace App\Controllers;

use App\Basecontroller;
use App\Models\FormValidation;
use App\Models\Database;
use App\Models\User;
use App\Helpers\Session;
use App\Request;
use Exception;

// Erlaubt einem Benutzer, ein neues Konto zu erstellen, indem er das Registrierungsformular ausfüllt und absendet.
class RegisterController extends BaseController {
    public function index(Request $request) {

        if($this->user->isLoggedIn()) {
            $this->redirectTo('/');
        }

        if ($request->getMethod() === 'GET') {
            $this->view->render('register/index');
            return;
        }

        // Input Validieren
        $formInput = $request->getInput('post');
        $validation = new FormValidation($formInput, $this->db);

         $validation->setRules([
             'username' => 'required|min:3|max:64|available:users',
             'email' => 'required|email|available:users',
             'password' => 'required|min:6|max:64',
             'passwordAgain' => 'required|matches:password'
         ]);

         $validation->setMessages([
            "passwordAgain.matches" => "Sie haben das Passwort nicht richtig wiederholt."
         ]);


         $validation->validate();

         if ($validation->fails()) {
             $this->view->render('register/index', [
                 'errors' => $validation->getErrors()
             ]);
         }


        // Schickt Daten an die DB
         try {
             $this->user->register(
                 $formInput['username'],
                 $formInput['email'],
                 $formInput['password']
             );
             Session::flash('success', '<div class="flashbox flashboxSuccess">Dein Account wurde erfolgreich erstellt. Logge dich jetzt ein.</div>');
             $this->redirectTo('/login');
         } catch (Exception $e){
             $this->view->render('login/index', [
                 'errors' => [
                     'root' => [$e->getMessage()]
                 ]
             ]);
         }
    }
}