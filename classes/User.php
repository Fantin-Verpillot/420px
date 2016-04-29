<?php

class User
{

    public static function checkCredential($pseudo, $password) {
        return $pseudo !== '' && $password !== '';
    }

    public static function getUser($pdo, $pseudo, $password) {
        try {
            $select = $pdo->query('SELECT * FROM user WHERE pseudo = "' . $pseudo . '"');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $user = $select->fetch();
            return $user && $user->password === $password ? array('id' => $user->id, 'pseudo' => $user->pseudo) : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function connectUser($user) {
        $_SESSION['user'] = $user;
    }

    public static function registerUser($pdo, $pseudo, $password) {
        try {
            $select = $pdo->query('SELECT id FROM user WHERE pseudo = "' . $pseudo . '"');
            $select->setFetchMode(PDO::FETCH_OBJ);
            if ($select->fetch()) {
                return array();
            }
            $pdo->exec('INSERT INTO user (pseudo, password) VALUES ("' . $pseudo . '", "' . $password . '")');
            $select = $pdo->query('SELECT * FROM user WHERE pseudo = "' . $pseudo . '"');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $user = $select->fetch();
            return $user ? array('id' => $user->id, 'pseudo' => $user->pseudo) : array();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getUsers($pdo) {
        try {
            $select = $pdo->query('SELECT * FROM user');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $users = array();
            while ($user = $select->fetch()) {
                $users[] = array('id' => $user->id, 'pseudo' => $user->pseudo);
            }
            return $users;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getUserPseudosById($pdo) {
        try {
            $select = $pdo->query('SELECT * FROM user');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $users = array();
            while ($user = $select->fetch()) {
                $users[$user->id] = $user->pseudo;
            }
            return $users;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getUserPseudoById($pdo, $idUser) {
        try {
            $select = $pdo->query('SELECT pseudo FROM user WHERE id = ' . $idUser);
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch()->pseudo;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function exists($pdo, $id) {
        try {
            $select = $pdo->query('SELECT pseudo FROM user WHERE id = ' . $id);
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
}