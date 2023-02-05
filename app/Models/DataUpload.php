<?php

namespace App\Controllers;

use BaseController;
use Database;
use ProfileController;
use Exception;


class DataUpload extends BaseController{

    private Database $db;
    public function index(){

    }

    public function __construct(Database $db)
    {

        $this->db = $db;
    }

    function getImages() : array {
    $query = 'SELECT * FROM files';

        $Statement = ( new Database() )->prepare( $query );
        $Statement->execute();

        return $Statement->fetchAll( \PDO::FETCH_ASSOC ) ?? [];
    }

    function submit_form() : void {
        echo "Hallo Welt";
        if ( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' ) {

            return;
        }

        /** @var ImageUpload $ImageUpload */
        $ImageUpload = new ImageUpload();
        /** @var ?array $file */
        $file = $_FILES[ 'upload' ] ?? NULL;
        /** @var ?string $alttext */
        $text = $_POST[ 'text' ] ?? NULL;

        if ( $ImageUpload->upload( $file, $text ) === FALSE ) {
            var_dump( $ImageUpload->errors );
        };

        $ImageUpload->uploadThumbnail( $file );
    }


    private function upload( string $path, string $alt){
        $sql = "
            INSERT INTO `profileImages`
            ( `Path`, `Alt`)
            VALUES (:Path, :Alt )
        ";

        $this->db->query($sql, [
            'Path' => $path,
            'Alt' => $alt
        ]);
//
//        // If there is an image, save it
//
//        if ($image === null) return;
//
//        $fileStorage = new FileStorage($image);
//        $fileStorage->saveIn('images');
//        $imageName = $fileStorage->getGeneratedName();
//
//        $sql = "SELECT MAX(`id`) AS 'id' FROM `posts` WHERE `user_id` = :user_id";
//
//        $postQuery = $this->db->query($sql, ['user_id' => $userId ]);
//        $postId = $postQuery->results()[0]['id'];
//
//        $sql = "
//            INSERT INTO `posts_images`
//            (`post_id`, `path`)
//            VALUES (:post_id, :path)
//        ";
//
//        $this->db->query($sql, [
//            'post_id' => $postId,
//            'path' => $imageName
//        ]);
    }
}

