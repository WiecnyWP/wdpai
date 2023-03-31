<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Art.php';
require_once __DIR__.'/../repository/ArtRepository.php';
class ArtController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg','image/jpg', 'image/svg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];

    private $artRepository;

    public function __construct()
    {
        parent::__construct();
        $this->artRepository = new ArtRepository();
    }

    public function search()
    {
        $arts = $this->artRepository->getArts();
        $this->render('search', ['arts' => $arts]);
    }
    public function add()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            $art = new Art($_POST['type'], $_POST['name'], $_POST['city'], $_FILES['file']['name']);
            $this->artRepository->addArt($art);
            return $this->render('search', ['messages' => $this->messages, 'arts' => $this->artRepository->getArts()]);
        }
        $this->render('add', ['messages' => $this->messages]);
    }

    public function searchArt()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($this->artRepository->getProjectByTitle($decoded['search']));
        }
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

    public function saveRate()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content);
            header('Content-Type: application/json');
            http_response_code(200);
            $this->artRepository->saveRate($decoded->rate, $decoded->id_art, $decoded->id_user);
            echo $decoded->rate;
        }
    }

    public function checkRateIsset()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content);
            header('Content-Type: application/json');
            http_response_code(200);
            $rate = $this->artRepository->getRateByUser($_COOKIE['id_user'], $decoded->id_art);
            if ($rate === false) {
                echo json_encode(['rate' => false]);
            } else {
                echo json_encode(['rate' => $rate['rate']]);
            }
        }
    }

}