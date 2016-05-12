<?php

$image = Image::getImageById($pdo, $_GET['param']);
switch ($_GET['effect']) {
    case 'sepia' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::sepia($image['path'], $extension);
        break;
    }
    case 'greyscale' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::greyscale($image['path'], $extension);
        break;
    }
    case 'gauss' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::gauss($image['path'], $extension);
        break;
    }
    case 'border' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::border($image['path'], $extension);
        break;
    }
    case 'lightplus' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::light($image['path'], $extension, -10);
        break;
    }
    case 'lightless' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::light($image['path'], $extension, 10);
        break;
    }
    case 'contrastplus' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::contrast($image['path'], $extension, 10);
        break;
    }
    case 'contrastless' : {
        $extension = explode('.', $image['path'])[1];
        $extension = $extension == 'jpg' ? 'jpeg' : $extension;
        Image::contrast($image['path'], $extension, -10);
        break;
    }
}
$res = Image::updateRGB($pdo, $_GET['param']);
if (!Tools::validate($res)) {
    $alert_error = Tools::internalError();
    exit();
}