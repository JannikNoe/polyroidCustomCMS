<?php

namespace App;

use App\Router;



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