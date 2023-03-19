<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();
        /*
        $options = [
            'cost' => 12,
        ];
        */
        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
        }

        $username = $_POST["username"];
        //$password = strval(password_hash($_POST["password"], PASSWORD_BCRYPT, $options));
        $password = $_POST["password"];
        //echo $password;

        $user = $userRepository->getUser($username);

        //echo $user->getPassword();

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


    public function registerAdd(){

        if (!$this->isPost()){
            return $this->render('login', ['messages' => ['']]);
        }
        /*
        $options = [
            'cost' => 12,
        ];
        */
        $user = new User(
            $_POST["name"],
            $_POST["surname"],
            $_POST["username"],
            //strval(password_hash($_POST["password"], PASSWORD_BCRYPT, $options))
            $_POST["password"]
        );

        $userRepository = new UserRepository();
        $userRepository->addUser($user);

        return $this->render('login');
    }
}