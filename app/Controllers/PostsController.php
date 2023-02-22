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

    // Zeigt den Inhalt eines einzelnen Posts anhand der ID in der URL an, oder leitet den Benutzer zur Startseite des Projekts weiter, falls der Post nicht gefunden werden kann.
    public function index(Request $request) {

        if (!isset($request->getInput('page')[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">Die Seite, auf die Sie zugreifen wollten, existiert nicht.</div>');
            $this->redirectTo('/');

        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if (!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">Dieser Beitrag konnte nicht gefunden werden.</div>');
            $this->redirectTo('/');
        }

        $this->view->render('posts/index', [
            'post' => $post
        ]);
    }
    /**
     * @param Request $request
     * @return void
     */
    // Funktion gestattet einem angemeldeten Benutzer, einen neuen Post zu erstellen, der einen Titel, eine Beschreibung
    // und ein Bild enthält. Die Eingaben des Benutzers werden validiert und in der Datenbank gespeichert.
    // Wenn die Erstellung erfolgreich war, wird der Benutzer zur Dashboard-Seite weitergeleitet.
    // Andernfalls wird die Seite zum Erstellen eines neuen Posts erneut angezeigt, um den Benutzer über Fehler zu informieren.
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
            $successMessage = '<div class="flashbox flashboxSuccess">Der Beitrag wurde erfolgreich erstellt</div>';
            $errorMessage = '<div class="flashbox flashboxError">Es ist etwas schiefgelaufen</div>';
            Session::flash('success', $successMessage);
            $this->redirectTo('/dashboard');
        } catch (Exception $e) {
            echo $errorMessage;
            d($e);

        }
    }

    //Funktion erlaubt einem Benutzer, seinen eigenen Post zu löschen, sofern er angemeldet ist und der Besitzer des Posts ist.
    // Wenn der Löschvorgang erfolgreich ist, wird der Benutzer zur Dashboard-Seite weitergeleitet. Andernfalls wird eine Fehlermeldung angezeigt, um den Benutzer über das Problem zu informieren.
    public function delete(Request $request) {
        if (!isset($request->getInput( 'page' )[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">Die Seite, auf die Sie zugreifen wollten, existiert nicht.</div>');
            $this->redirectTo('/dashboard');
        }

        $id = $request->getInput('page')[0];

        $post = new Post($this->db);

        if(!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">Dieser Beitrag wurde bereits gelöscht</div>');
            $this->redirectTo('/dashboard');
        }

        if (!$this->user->isLoggedIn() || $this->user->getId() !== $post->getUserId()) {
            Session::flash('error', '<div class="flashbox flashboxError">Um diesen Post zu bearbeiten fehlen Ihnen die Berechtigungen.</div>');
            $this->redirectTo('/dashboard');
        }

        if (!$post->delete()) {
            Session::flash('error', '<div class="flashbox flashboxError">Es ist etwas schiefgelaufen.</div>');
            $this->redirectTo('/dashboard');
        }

        Session::flash('success', '<div class="flashbox flashboxSuccess">Der Beitrag wurde erfolgreich entfernt.</div>');
        $this->redirectTo('/dashboard');
    }


    // Erlaubt dem Nutzer, seine eigenen Posts anhand der Validierungsregeln zu bearbeiten.
    public function edit(Request $request) {

        if (!isset($request->getInput('page')[0])) {
            Session::flash('error', '<div class="flashbox flashboxError">Sie müssen diese Seite über einen gültigen Link aufrufen</div>');
            $this->redirectTo('/dashboard');
        }

        $id = intval($request->getInput('page')[0]);
        $post = new Post($this->db);

        if(!$post->find($id)) {
            Session::flash('error', '<div class="flashbox flashboxError">Dieser Beitrag existiert nicht</div>');
            $this->redirectTo('/dashboard', 404);
        }


        if (!$this->user->isLoggedIn() || $this->user->getId() !== $post->getUserId()) {
            Session::flash('error', '<div class="flashbox flashboxError">Um diesen Post zu bearbeiten fehlen Ihnen die Berechtigungen.</div>');
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
            'title' => 'required|min:10|max:100',
            'body' => 'required|min:100'
        ]);

        $validation->validate();

        if($validation->fails()) {
            $this->view->render('post/edit', [
                'post' => $post,
                'errors' => $validation->getErrors()
            ], 422);
        }

        if (!$post->edit($formInput['title'], $formInput['body'])) {
            Session::flash('error', '<div class="flashbox flashboxError">Beim Versuch, Ihren Beitrag zu aktualisieren, ist ein Fehler aufgetreten.</div>');
            $this->view->render('posts/edit', [
                'post' => $post
            ]);
        };

        Session::flash('error', '<div class="flashbox flashboxSuccess">Der Post wurde erfolgreich aktualisiert.</div>');
        $this->redirectTo("/posts/{$post->getId()}/{$post->getSlug()}");

    }
}
