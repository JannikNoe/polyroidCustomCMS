<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\NotFoundController;

// Der Router ist eine Klasse, die URLs verarbeitet und entscheidet,
// welcher Controller und welche Methode aufgerufen werden soll.
class Router {

    private string $controller = HomeController::class;
    private string $method = 'index';
    private array $params = [];

    //bereinigt und zerlegt die URL in ihre Bestandteile. Anschließend wird der angeforderte Controller und die angeforderte Methode aus den Bestandteilen der URL abgeleitet.
    public function __construct() {

        $url = $this->parseUrl();
        if (!$url) return;

        $requestedController = 'App\\Controllers\\' . ucfirst(strtolower($url[0])) . 'Controller';

        if (!class_exists($requestedController)) {

            $this->controller = NotFoundController::class;
            return;
        }

        $this->controller = $requestedController;
        unset($url[0]);

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = array_values($url);
    }


    // wird verwendet, um die URL der aktuellen Anfrage zu bereinigen und in ihre Bestandteile zu zerlegen.
    private function parseUrl() {
        if (!isset($_GET['url'])) {
            return [];
        }

        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

    // gibt den Namen des angeforderten Controllers als String zurück, der im Router-Objekt gespeichert ist.
    public function getRequestedController(): string {
        return $this->controller;
    }

    // gibt den Namen der aufgerufenen Methode der angeforderten URL zurück, die im Router-Objekt gespeichert wurde.
    public function getRequestedMethod(): string {
        return $this->method;
    }

    // gibt ein Array zurück, welches alle Parameter der URL enthält, die von der Anfrage stammen.
    // Diese Parameter werden aus der URL extrahiert und in einem Array gespeichert.
    // Das Array enthält dann in der Regel die Parameter, die nach dem Controller und der Methode in der URL kommen.
    public function getParams(): array {
        return $this->params;
    }

}

