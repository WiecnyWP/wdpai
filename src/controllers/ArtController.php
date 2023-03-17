<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Art.php';
class ArtController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', 'image/svg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    public function add()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);
            $art = new Art($_POST['type'], $_POST['name'], $_POST['city'], $_FILES['file']['name']);
            return $this->render('search', ['messages' => $this->messages, 'art' => $art]);
        }
        $this->render('add', ['messages' => $this->messages]);
    }

    private function validate(array $file) : bool
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large to upload';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File is not supported';
            return false;
        }

        return true;
    }
}