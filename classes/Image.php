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

    public static function addImage($pdo, $userId, $extension, $rgb) {
        $stringRGB = $rgb['r'] . ',' . $rgb['g'] . ',' . $rgb['b'];
        try {
            $select = $pdo->query('SELECT max(id) + 1 as max FROM image');
            $select->setFetchMode(PDO::FETCH_OBJ);
            $idImage = $select->fetch()->max;
            $pdo->exec('INSERT INTO image (id, path, user_id, rgb) VALUES (' . intval($idImage) . ', \'files/img_'
                . intval($idImage) . '.' . $extension.'\', ' . intval($userId).', \''.$stringRGB.'\')');
            return $idImage;
        } catch (PDOException $e) {
            var_dump('hahaha');
            return null;
        }
    }

    public static function updateRGB($pdo, $id, $path, $extension) {
        $rgb = self::getDominantRGB($path, $extension);
        if ($rgb == null) {
            return null;
        }
        try {
            $pdo->exec('UPDATE image SET rgb =\'' . $rgb['r'] . ',' . $rgb['g'] . ',' . $rgb['b'] . '\' WHERE id = ' . intval($id));
            return true;
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
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_GRAYSCALE);
            imagefilter($img, IMG_FILTER_COLORIZE, 100, 50, 0);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function greyscale($path, $extension)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_GRAYSCALE);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function gauss($path, $extension)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function border($path, $extension)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_EDGEDETECT);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function light($path, $extension, $amount)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_BRIGHTNESS, $amount);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function contrast($path, $extension, $amount)
    {
        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if ($img) {
            imagesavealpha($img, true);
            imagefilter($img, IMG_FILTER_CONTRAST, $amount);
            $funcSaveImage = 'image' . $extension;
            $funcSaveImage($img, $path);
            return true;
        }
        return null;
    }

    public static function getRGBById($pdo, $id) {
        try {
            $select = $pdo->query('SELECT rgb FROM image WHERE id = ' . intval($id));
            $select->setFetchMode(PDO::FETCH_OBJ);
            $image = $select->fetch();
            $rgb = explode(',', $image->rgb);
            return array('r' => $rgb[0], 'g' => $rgb[1], 'b' => $rgb[2]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getDominantRGB($path, $extension) {
        $rgbRes = array('r' => 0, 'g' => 0, 'b' => 0);
        $cardinal = 0;

        $funcCreateImage = 'imagecreatefrom' . $extension;
        $img = $funcCreateImage($path);
        if (!$img) {
            return null;
        }

        for ($x = 0; $x < imagesx($img); $x++) {
            for ($y = 0; $y < imagesy($img); $y++) {
                $rgb = imagecolorat($img, $x, $y);
                $rgbRes['r'] += ($rgb >> 16) & 0xFF;
                $rgbRes['g'] += ($rgb >> 8) & 0xFF;
                $rgbRes['b'] += $rgb & 0xFF;
                $cardinal++;
            }
        }
        $rgbRes['r'] = round($rgbRes['r'] / $cardinal);
        $rgbRes['g'] = round($rgbRes['g'] / $cardinal);
        $rgbRes['b'] = round($rgbRes['b'] / $cardinal);
        return $rgbRes;
    }

    public static function equalsRGB($rgbArray1, $rgbArray2) {
        return $rgbArray1['r'] == $rgbArray2['r'] && $rgbArray1['g'] == $rgbArray2['g'] && $rgbArray1['b'] == $rgbArray2['b'];
    }

    public static function getImagesByRGB($pdo, $rgbArray) {
        $images = array();
        $allImages = self::getImages($pdo);
        if ($allImages === null) {
            return null;
        }

        foreach ($allImages as $anImage) {
            $rgb = self::getRGBById($pdo, $anImage['id']);
            if ($rgb === null) {
                return null;
            }

            if (self::equalsRGB($rgb, $rgbArray)) {
                $images[$anImage['id']] = $anImage['path'];
            }
        }
        return $images;
    }
}