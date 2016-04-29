<?php

$imageTemp = Image::getImageById($pdo, $_GET['param']);

if (!Tools::validate($imageTemp)) {
    $alert_error = Tools::internalError();
    exit();
}

$image = $imageTemp['path'];
$imageId = $_GET['param'];

$userPseudo = User::getUserPseudoById($pdo, $imageTemp['user_id']);

if (!Tools::validate($userPseudo)) {
    $alert_error = Tools::internalError();
    exit();
}

$userId = $imageTemp['user_id'];

if ($userId === $idUserConnected) {
    $userPseudo = 'Photo &agrave; vous';
} else {
    $userPseudo = 'Photo de '.$userPseudo;
}
