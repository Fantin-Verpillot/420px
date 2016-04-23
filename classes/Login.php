<?php

class Login
{
    public static function getUser($pdo, $pseudo, $password) {
        if (empty($pseudo) || empty($password)) {
            return null;
        }

        $select = $pdo->query('SELECT * FROM user WHERE pseudo = "'.$pseudo.'"');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $user = $select->fetch();
        return $user && $user->password === $password ? array('id' => $user->id, 'pseudo' => $user->pseudo) : null;
    }

    public static function connectUser($user) {
        $_SESSION['user'] = $user;
    }
}