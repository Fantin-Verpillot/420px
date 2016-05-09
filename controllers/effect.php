<?php

$image = Image::getImageById($pdo, $_GET['param']);
switch ($_GET['effect']) {
    case 'sepia' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::sepia($image['path'], $extension);
    }
}
