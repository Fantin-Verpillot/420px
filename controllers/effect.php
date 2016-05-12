<?php

$image = Image::getImageById($pdo, $_GET['param']);
if (!Tools::validate($image)) {
    $alert_error = Tools::internalError();
    exit();
}

$extension = explode('.', $image['path'])[1];
$extension = $extension == 'jpg' ? 'jpeg' : $extension;
switch ($_GET['effect']) {
    case 'sepia' : {
        Image::sepia($image['path'], $extension);
        break;
    }
    case 'greyscale' : {
        Image::greyscale($image['path'], $extension);
        break;
    }
    case 'gauss' : {
        Image::gauss($image['path'], $extension);
        break;
    }
    case 'border' : {
        Image::border($image['path'], $extension);
        break;
    }
    case 'lightplus' : {
        Image::light($image['path'], $extension, -10);
        break;
    }
    case 'lightless' : {
        Image::light($image['path'], $extension, 10);
        break;
    }
    case 'contrastplus' : {
        Image::contrast($image['path'], $extension, 10);
        break;
    }
    case 'contrastless' : {
        Image::contrast($image['path'], $extension, -10);
        break;
    }
}

$res = Image::updateRGB($pdo, $_GET['param'], $image['path'], $extension);
if (!Tools::validate($res)) {
    $alert_error = Tools::internalError();
    exit();
}