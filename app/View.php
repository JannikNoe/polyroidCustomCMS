<?php

namespace App;

use App\Helpers\Session;
use App\Models\User;

// ist für das Rendern von HTML-Vorlagen in der Webanwendung zuständig.
class View {
    private User $user;

    // wird für die Authentifizierung verwendet
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // nimmt eine Vorlagen-Datei und optionale Daten-Array sowie einen optionalen HTTP-Statuscode entgegen.
    // Die Methode rendert die Vorlage und die Teile
    // des Templates (Header und Footer) werden zusammengefügt und die Daten werden in die Vorlage eingefügt.
    public function render(string $view, array $data = [], int $statusCode = 200)
    {
        http_response_code($statusCode);

        $user = $this->user;
        $session = Session::class;

        extract($data);

        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/partials/header.php");
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/{$view}.php");
        require_once __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, "/Views/partials/footer.php");

        exit();
    }
}