<?php

namespace App\Models;

use App\Models\Database;
use Exception;
use App\Helpers\Session;

class User {

    private Database $db;
    private string $id;
    private string $email;
    private string $password;
    private string $username;
    private string $joinedAt;

    public function __construct(Database $db) {

        $this->db = $db;
    }

    // Methode sucht nach einem Benutzer anhand seiner ID oder E-Mail-Adresse in der Datenbank.
    public function find(int|string $identifier): bool
    {

        $column = is_int($identifier) ? 'id' : 'email';
        $sql = "SELECT * FROM `users` WHERE `{$column}` = :identifier";
        $userQuery = $this->db->query($sql, [ 'identifier' => $identifier ]);

        if (!$userQuery->count()) {
            return false;
        }

        $userData = $userQuery->results()[0];

        foreach ($userData as $column => $value) {
            $this->{$column} = $value;
        }

        return true;
    }

    // Methode wird verwendet, um einen neuen Benutzer zu registrieren. Sie nimmt den Benutzernamen,
    // die E-Mail-Adresse und das Passwort als Parameter und speichert sie in der Datenbank.
    // Das Passwort wird mit dem password_hash()-Funktion gehasht.
    public function register(string $username, string $email, string $password): void
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

        $sql = "
            INSERT INTO `users`
            (`username`, `email`, `password`, `joined_at`)
            VALUES (:username, :email , :password, :joinedAt)
            
        ";

        $this->db->query($sql, [
            'username'  => $username,
            'email'     => $email,
            'password'  => $passwordHash,
            'joinedAt'  => time()
        ]);
    }
    // Methode wird verwendet, um einen Benutzer anzumelden. Sie überprüft, ob die E-Mail-Adresse in
    // der Datenbank vorhanden ist und ob das Passwort korrekt ist.
    // Wenn alles korrekt ist, wird eine Sitzung für den Benutzer erstellt.
    public function login(string $email, string $password): void
    {
        // Abgleich mit DB
        // Versuchen User zu finden
        if (!$this->find($email)) {
            throw new Exception('The emailadress could not be found.');
        }

        // Passwörter abgleichen
        if (!password_verify($password, $this->password) ) {
            throw new Exception('Passwort falsch habibi.');
        }

        // Session erstellen
        Session::set('userId', (int) $this->id);

    }

    // Methode wird verwendet, um den Benutzer abzumelden. Sie löscht die Sitzung des Benutzers.
    public function logout(): void {
        Session::delete('userId');
    }

    // Methode gibt an, ob der Benutzer eingeloggt ist oder nicht, indem geprüft wird, ob die Sitzung des Benutzers existiert
    public function isLoggedIn(): bool
    {
        return Session::exists('userId');
    }

    // Methode gibt die ID des Benutzers zurück. Wenn die ID bereits im Objekt gespeichert ist,
    // wird diese zurückgegeben, andernfalls wird die ID aus der Sitzung geholt.
    public function getId(): int
    {
        if (isset($this->id)) {
            return (int) $this->id;
        }

        return Session::get('userId');
    }

    // Methode gibt den Benutzernamen des Benutzers zurück.
    public function getUsername(): string {
        return $this->username;
    }

    // Methode gibt die E-Mail-Adresse des Benutzers zurück.
    public function getEmail(): string {
        return $this->email;
    }

    // Methode gibt eine Liste der Beiträge des Benutzers zurück. Es wird eine SQL-Abfrage ausgeführt,
    // um alle Beiträge mit der ID des Benutzers abzurufen,
    // und dann werden die Ergebnisse in eine Liste von Post-Objekten umgewandelt.
    public function getPosts(): array {
        $sql = "SELECT * FROM `posts` WHERE `user_id` = :userId";

        $postsQuery = $this->db->query($sql, [ 'userId' => $this->getId() ]);

        $posts = [];

        foreach ($postsQuery->results() as $result) {
            $posts[] = new Post($this->db, $result);
        }

        return $posts;

    }

}