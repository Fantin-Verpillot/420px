<?php

class Image
{
    public static function getImagesByUsers($pdo) {
        $images = self::getImages($pdo);
        $users = User::getUsers($pdo);
        $imagesByUser = array();
        foreach($users as $user) {
            $imagesByUser[$user['id']] = array();
            foreach ($images as $image) {
                if ($image['user_id'] === $user['id']) {
                    if (count($imagesByUser[$user['id']]) < 3) {
                        $imagesByUser[$user['id']][$image['id']] = $image['path'];
                    } else {
                        break;
                    }
                }
            }
        }
        return $imagesByUser;
    }

    public static function getImagesByUser($pdo, $idUser) {
        $select = $pdo->query('SELECT * FROM image WHERE user_id = '.$idUser);
        $select->setFetchMode(PDO::FETCH_OBJ);
        $images = array();
        while($image = $select->fetch()) {
            $images[$image->id] = $image->path;
        }
        return $images;
    }

    public static function getImages($pdo) {
        $select = $pdo->query('SELECT * FROM image');
        $select->setFetchMode(PDO::FETCH_OBJ);
        $images = array();
        while($image = $select->fetch()) {
            $images[] = array('id' => $image->id, 'path' => $image->path, 'user_id' => $image->user_id);
        }
        return $images;
    }

    public static function getImageById($pdo, $id) {
        $select = $pdo->query('SELECT * FROM image WHERE id = '.$id);
        $select->setFetchMode(PDO::FETCH_OBJ);
        $image = $select->fetch();
        return array('id' => $image->id, 'path' => $image->path, 'user_id' => $image->user_id);
    }

    public static function exists($pdo, $id) {
        $select = $pdo->query('SELECT path FROM image WHERE id = '.$id);
        $select->setFetchMode(PDO::FETCH_OBJ);
        return $select->fetch() !== false;
    }
}