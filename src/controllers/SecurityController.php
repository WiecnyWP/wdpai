<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();


        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($username);

        if (!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

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