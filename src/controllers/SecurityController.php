<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login', ['messages' => ['']]);
        }

        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = $userRepository->getUser($username);


        if (!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if ($user->getUsername() !== $username) {
            return $this->render('login', ['messages' => ['Username does not exist!']]);
        }


        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        setcookie("id_user", $user->getId(), time()+1800, '/');
        setcookie("id_user_privilege", $user->getIdPrivilege(), time()+1800, '/');


        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/hau");

    }
    
    public function registerAdd()
    {

        if (!$this->isPost()) {
            return $this->render('login', ['messages' => ['']]);
        }

        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $options = [
            'cost' => 12,
        ];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        $user = new User(
            $name,
            $surname,
            $username,
            $hashedPassword
        );

        $userRepository = new UserRepository();
        $userRepository->addUser($user);

        return $this->render('login');

    }
}