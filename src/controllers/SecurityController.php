<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('Jan', 'Kowalski', 'kowalski', 'admin');

        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($user->getUsername() !== $username)
        {
            return $this->render('login', ['messages' => ['Username does not exist!']]);
        }

        if ($user->getPassword() !== $password)
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('hau');

    }
}