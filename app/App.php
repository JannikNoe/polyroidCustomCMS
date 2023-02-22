<?php

namespace App;

use App\Router;



// Die Klasse App hat einen Konstruktor, der Klassen automatisch lädt und dann den angeforderten
// Controller mit der entsprechenden Methode und den übergebenen Parametern erstellt und aufruft.
class App {
    public function __construct() {

        $this->autoloadClasses();

        $router = new \App\Router;

        $requestedController = $router->getRequestedController();
        $requestedMethod = $router->getRequestedMethod();
        $params = $router->getParams();

        $controller = new $requestedController;

        $request = new Request($params);

        $controller-> {$requestedMethod}($request);
    }

    // registriert eine Funktion, die aufgerufen wird, wenn eine Klasse aufgerufen wird, die noch nicht geladen wurde.
    // Diese Funktion sucht dann die entsprechende Datei und lädt sie, wenn sie gefunden wird.
    private function autoloadClasses() {
        spl_autoload_register(function ($namespace) {
           $projectsNamespace = 'App\\';
           $classname = str_replace($projectsNamespace, '', $namespace);
           $filePath = __DIR__ . DIRECTORY_SEPARATOR .str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';

            if (file_exists($filePath)) {
                require_once $filePath;
            }
        });
    }
}