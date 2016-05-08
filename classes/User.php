<?php

class User
{

    public static function checkCredential($pseudo, $password) {
        return $pseudo !== '' && $password !== '';
    }

    public static function getUser($pdo, $pseudo, $password) {
        $pseudo = htmlspecialchars($pseudo);
        try {
            $select = $pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
            $select->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_OBJ);
            $user = $select->fetch();
            return $user && $user->password === $password ? array('id' => $user->id, 'pseudo' => $user->pseudo) : array();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function connectUser($user) {
        $_SESSION['user'] = $user;
    }

    public static function registerUser($pdo, $pseudo, $password) {
        $pseudo = htmlspecialchars($pseudo);
        $password = htmlspecialchars($password);
        try {
            $select = $pdo->prepare('SELECT id FROM user WHERE pseudo = :pseudo');
            $select->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $select->execute();
            $select->setFetchMode(PDO::FETCH_OBJ);
            if ($select->fetch()) {
                return array();
            }
            $insert = $pdo->prepare('INSERT INTO user (pseudo, password) VALUES (:pseudo, :password)');
            $insert->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $insert->bindValue(':password', $password, PDO::PARAM_STR);
            $insert->execute();

            $select = $pdo->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
            $select->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $select->execute();
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
            $select = $pdo->query('SELECT pseudo FROM user WHERE id = ' . intval($idUser));
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch()->pseudo;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function exists($pdo, $id) {
        try {
            $select = $pdo->query('SELECT pseudo FROM user WHERE id = ' . intval($id));
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
}