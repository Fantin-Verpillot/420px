<?php

class User
{

    public static function checkCredential($pseudo, $password) {
        return $pseudo !== '' && $password !== '';
    }

    public static function getUser($pdo, $pseudo, $password) {
        $select = $pdo->query('SELECT * FROM user WHERE pseudo = "'.$pseudo.'"');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $user = $select->fetch();
        return $user && $user->password === $password ? array('id' => $user->id, 'pseudo' => $user->pseudo) : null;
    }

    public static function connectUser($user) {
        $_SESSION['user'] = $user;
    }

    public static function registerUser($pdo, $pseudo, $password) {
        $select = $pdo->query('SELECT id FROM user WHERE pseudo = "'.$pseudo.'"');
        $select->setFetchMode(PDO::FETCH_OBJ);
        if ($select->fetch()) {
            return null;
        }
        $pdo->exec('INSERT INTO user (pseudo, password) VALUES ("'.$pseudo.'", "'.$password.'")');
        $select = $pdo->query('SELECT * FROM user WHERE pseudo = "'.$pseudo.'"');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $user = $select->fetch();
        return $user ? array('id' => $user->id, 'pseudo' => $user->pseudo) : null;
    }

    public static function getUsers($pdo) {
        $select = $pdo->query('SELECT * FROM user');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $users = array();
        while($user = $select->fetch()) {
            $users[] = array('id' => $user->id, 'pseudo' => $user->pseudo);
        }
        return $users;
    }

    public static function getUserPseudosById($pdo) {
        $select = $pdo->query('SELECT * FROM user');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $users = array();
        while($user = $select->fetch()) {
            $users[$user->id] = $user->pseudo;
        }
        return $users;
    }

    public static function getUserPseudoById($pdo, $idUser) {
        $select = $pdo->query('SELECT pseudo FROM user WHERE id = '.$idUser);
        $select->setFetchMode(PDO::FETCH_OBJ);
        return $select->fetch()->pseudo;
    }

    public static function exists($pdo, $id) {
        $select = $pdo->query('SELECT pseudo FROM user WHERE id = '.$id);
        $select->setFetchMode(PDO::FETCH_OBJ);
        return $select->fetch() !== false;
    }
}