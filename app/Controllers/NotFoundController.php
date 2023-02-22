<?php

namespace App\Controllers;

class NotFoundController {
    public function index() {
        http_response_code(404);
        echo '<div style="font-size: 0.9em;
            text-align: center;
            position: relative;
            border-radius: 12px;
            width: 400px;
            padding: 20px;
            left: 50%;
            top: 40px;
            background-color: red;
            color: white;
            transform: translateX(-50%);">
               Seite nicht gefunden
            </div>';
    }

}