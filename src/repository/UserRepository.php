<?php


require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class UserRepository extends Repository
{
    public function getUser(string $username) : ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users u JOIN public.users_data ud ON u.id_user_data=ud.id_user_data WHERE username = :username;
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['name'],
            $user['surname'],
            $user['username'],
            $user['password']
        );
    }

    public function addUser(User $user): void {
        $stmt = $this->database->connect()->prepare('
            CALL add_user(?, ?, ?, ?);
        ');
        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getUsername(),
            $user->getPassword()
        ]);
    }

}