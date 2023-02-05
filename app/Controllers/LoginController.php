<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'BaseController.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR .  'FormValidation.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR .  'Database.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR .  'User.php';


class LoginController extends BaseController {
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view->render('login/index');
            return;
        }


        // Post
        // Input Validieren
        $formInput = $_POST;
        $validation = new FormValidation($formInput);

         $validation->setRules([
             'email' => 'required|email|min:3|max:255', // mail ausgeklammert
             'password' => 'required|min:6|max:255',
//              Für eine registrierung relevant
//             'passwordAgain' => 'required|matches:password'
         ]);


         $validation->validate();

         if ($validation->fails()) {
             $this->view->render('login/index', [
                 'errors' => $validation->getErrors()
             ]);
         }


        // User Login
         $db = new Database;
         $user = new User($db);
         try {
             $user->login($formInput['email'], $formInput['password']);
             header('Location: /');
         } catch (Exception $e){
             $this->view->render('login/index', [
                 'errors' => [
                     'root' => [$e->getMessage()]
                 ]
             ]);
         }

    }
}