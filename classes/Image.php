<?php

class Image
{

    public static function deleteImage($pdo, $idImage) {
        try {
            $image = self::getImageById($pdo, $idImage);
            if ($image === null) {
                return null;
            }
            unlink($image['path']);
            $pdo->exec('DELETE FROM image WHERE id = ' . $idImage);
            return true;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function addImage($pdo, $userId, $extension) {
        try {
            $select = $pdo->query('SELECT max(id) + 1 as max FROM image');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $idImage = $select->fetch()->max;
            $pdo->exec('INSERT INTO image (id, path, user_id) VALUES ('.$idImage.', \'files/img_'.$idImage.'.'.$extension.'\', '.$userId.')');
            return $idImage;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function ownedBy($pdo, $idImage, $idUserConnected) {
        try {
            $select = $pdo->query('SELECT user_id FROM image WHERE id = ' . $idImage);
            $select->setFetchMode(PDO::FETCH_OBJ);
            $image = $select->fetch();
            return $image->user_id === $idUserConnected;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getImagesByUsers($pdo) {
        try {
            $images = self::getImages($pdo);
            if ($images === null) {
                return null;
            }
            $users = User::getUsers($pdo);
            if ($users === null) {
                return null;
            }
            $imagesByUser = array();
            foreach ($users as $user) {
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
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getImagesByUser($pdo, $idUser) {
        try {
            $select = $pdo->query('SELECT * FROM image WHERE user_id = ' . $idUser);
            $select->setFetchMode(PDO::FETCH_OBJ);
            $images = array();
            while ($image = $select->fetch()) {
                $images[$image->id] = $image->path;
            }
            return $images;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getImages($pdo) {
        try {
            $select = $pdo->query('SELECT * FROM image');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $images = array();
            while ($image = $select->fetch()) {
                $images[] = array('id' => $image->id, 'path' => $image->path, 'user_id' => $image->user_id);
            }
            return $images;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getImageById($pdo, $id) {
        try {
            $select = $pdo->query('SELECT * FROM image WHERE id = ' . $id);
            $select->setFetchMode(PDO::FETCH_OBJ);
            $image = $select->fetch();
            return array('id' => $image->id, 'path' => $image->path, 'user_id' => $image->user_id);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function exists($pdo, $id) {
        try {
            $select = $pdo->query('SELECT path FROM image WHERE id = ' . $id);
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
}