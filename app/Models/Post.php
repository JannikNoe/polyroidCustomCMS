<?php

namespace App\Models;

use App\Models;
use App\Helpers\Str;
use App\Models\Database;
use App\Models\FileStorage;


class Post {

    // Eigenschaften
    private Database $db;
    private string $id;
    private string $title;
    private string $body;
    private string $slug;
    private string $createdAt;
    private string $updatedAt;
    private string $user_id;
    private array $images;


    // Der Konstruktor der Klasse. Wenn ein Array von Daten als zweites Argument übergeben wird,
    // werden diese Daten in die Instanz der Klasse geladen.
    public function __construct(Database $db, ?array $data = []) {
        $this->db = $db;
        $this->fill($data);
    }

    // Eine Methode, die ein Array von Daten entgegennimmt und die Eigenschaften der Klasse mit den Daten füllt.
    // Die Schlüssel des Arrays werden in CamelCase umgewandelt und mit dem Namen der Eigenschaft übereinstimmend verwendet.
    public function fill(array $data = []) {
        foreach ($data as $field => $value) {
            $this->{Str::toCamelCase($field)} = $value;
        }
    }

    // Eine Methode, die einen Beitrag anhand der übergebenen ID in der Datenbank sucht. Wenn der Beitrag gefunden wird, wird er in die Instanz der Klasse geladen,
    // und die Methode gibt true zurück. Andernfalls gibt sie false zurück.
    public function find(int $identifier): bool {
        $sql = "SELECT * FROM  `posts` WHERE `id` = :identifier";
        $postQuery = $this->db->query($sql, ['identifier' => $identifier]);

        if (!$postQuery->count()) {
            return false;
        }

        $this->fill($postQuery->results()[0]);
        return true;

    }

    // Eine Methode, die die sechs neuesten Beiträge aus der Datenbank abruft und jedes Ergebnis in eine Instanz der Klasse Post konvertiert.
    // Die Methode gibt ein Array von Post-Instanzen zurück.
    public function findLatest(): array {
        $sql = "SELECT * FROM  `posts` ORDER BY `created_at` DESC LIMIT 6";
        $postQuery = $this->db->query($sql);

        $posts = [];

        foreach ($postQuery->results() as $result) {
            $posts[] = new Post($this->db, $result);
        }

        return $posts;

    }

    // Eine Methode, die einen neuen Beitrag in der Datenbank erstellt.
    // Optional kann ein Array von Bildern übergeben werden.
    public function create(int $userId, string $title, string $body, array $image = null) {

        $sql = "
            INSERT INTO `posts`
            (`user_id`, `title`, `slug`, `body`, `created_at`, `updated_at`)
            VALUES (:userId, :title, :slug, :body, :createdAt, :updatedAt)
        ";

        $slug = Str::slug($title);


        $this->db->query($sql, [
            'userId' => $userId,
            'title' => $title,
            'slug' => $slug,
            'body' => $body,
            'createdAt' => time(),
            'updatedAt' => time()
        ]);

        if($image === null) return;

        $fileStorage = new FileStorage($image);
        $fileStorage->saveIn('src/images');
        $imageName = $fileStorage->getGeneratedName();

        $sql = "SELECT MAX(`id`) AS 'id' FROM `posts` WHERE `user_id` = :user_id";

        $postQuery = $this->db->query($sql , [
            'user_id' => $userId
        ]);

        $postId = $postQuery->results()[0]['id'];

        $sql = "
            INSERT INTO `posts_images`
            (`post_id`, `path`)
            VALUES(:post_id, :path)";
        
            $this->db->query($sql, [
                'post_id' => $postId,
                'path' => $imageName
            ]);
    }

    // Eine Methode, die den Titel und Inhalt des Beitrags in der Datenbank aktualisiert.
    // Die Methode gibt true zurück, wenn die Aktualisierung erfolgreich war, ansonsten false.
    public function edit(string $title, string $body):bool {
        $sql = "
          UPDATE `posts`
          SET `title` = :title, `slug` = :slug, `body` = :body, `updated_at` = :updatedAt
          WHERE `id` = :id
        ";

        $slug = Str::slug($title);

        $postData = [
            'id' => $this->getId(),
            'title' => $title,
            'slug' => $slug,
            'body' => $body,
            'updatedAt' => time()
        ];

        $editQuery = $this->db->query($sql, $postData);
        $this->fill($postData);

        return (bool) $editQuery->count();
    }

    // Eine Methode, die den Beitrag aus der Datenbank löscht. Die Methode gibt true zurück,
    // wenn der Beitrag erfolgreich gelöscht wurde, ansonsten false.
    public function delete(): bool {

        $images = $this->getImages();

        foreach ($images as $image) {
            FileStorage::delete($image);
        }

        $sql = "DELETE FROM `posts` WHERE `id` = :id";
        $deleteQuery = $this->db->query($sql, [ 'id' => $this->getId() ]);

        return (bool) $deleteQuery->count();
    }

    // Eine Methode, die die ID des Beitrags zurückgibt.
    public function getId(): int {
        return (int) $this->id;
    }

    // Eine Methode, die den Title des Beitrags zurückgibt
    public function getTitle(): string {
        return $this->title;
    }

    // Eine Methode, die den Body - also den Fließtext des Beitrags zurückgibt
    public function getBody(): string {
        return $this->body;
    }
    // Eine Methode, die das Erstellungsdatum des Beitrags zurückgibt
    public function getCreatedAt(): string {
        return date('D, d.m.Y', $this->createdAt);
    }

    // Eine Methode, die die User-ID des Beitragerstellers zurückgibt
    public function getUserId(): int {
        return (int) $this->userId;
    }

    // Gibt den Slug des Beitrags zurück
    public function getSlug(): string {
        return $this->slug;
    }

    // Eine Methode, die den Usernamen des Beitragserstellers zurückgibt.
    public function getUser(): User {
        $user = new User($this->db);
        $user->find($this->getUserId());
        return $user;
    }

    // Eine Methode, die das Bild des Beitrags zurückgibt.
    public function getImages(): array {

        if (isset($this->images)) {
            return $this->images;
        }

        $sql = "SELECT `path` FROM `posts_images` WHERE `post_id` = :postId";
        $imagesQuery = $this->db->query($sql, [ 'postId' => $this->getId() ]);

        $this->images = array_map(function ($image) {
            return DIRECTORY_SEPARATOR . 'src' .  DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $image[ 'path'];
        }, $imagesQuery->results());

        return $this->images;
    }
}