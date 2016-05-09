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
            $pdo->exec('DELETE FROM image WHERE id = ' . intval($idImage));
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
            $pdo->exec('INSERT INTO image (id, path, user_id) VALUES (' . intval($idImage) . ', \'files/img_'
                . intval($idImage) . '.' . $extension.'\', ' . intval($userId).')');
            return $idImage;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function ownedBy($pdo, $idImage, $idUserConnected) {
        try {
            $select = $pdo->query('SELECT user_id FROM image WHERE id = ' . intval($idImage));
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
            $select = $pdo->query('SELECT * FROM image WHERE user_id = ' . intval($idUser));
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
            $select = $pdo->query('SELECT * FROM image WHERE id = ' . intval($id));
            $select->setFetchMode(PDO::FETCH_OBJ);
            $image = $select->fetch();
            return array('id' => $image->id, 'path' => $image->path, 'user_id' => $image->user_id);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function exists($pdo, $id) {
        try {
            $select = $pdo->query('SELECT path FROM image WHERE id = ' . intval($id));
            $select->setFetchMode(PDO::FETCH_OBJ);
            return $select->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function resize($path, $extension)
    {
        $width = 420;
        $height = 420;
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $src = $funcCreateImage($path);
        $dest = imagecreatetruecolor($width, $height);
        if ($dest) {
            imagealphablending($dest, false);
            imagesavealpha($dest, true);
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($dest, $path);
            return true;
        }
        return null;
    }

    public static function sepia($path, $extension)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagefilter($img, IMG_FILTER_GRAYSCALE);
            imagefilter($img, IMG_FILTER_COLORIZE, 100, 50, 0);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            //imagedestroy($img);
            return true;
        }
        return null;
    }
}