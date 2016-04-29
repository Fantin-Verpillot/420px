<?php

$images = Image::getImagesByUser($pdo, $_GET['param']);
$userPseudo = User::getUserPseudoById($pdo, $_GET['param']);
$userId = $_GET['param'];

if (!Tools::validateAll(array($images, $userPseudo, $userId))) {
    $alert_error = Tools::internalError();
    exit();
}

if ($_GET['param'] === $idUserConnected) {
    $userPseudo = 'Vos photos';
} else {
    $userPseudo = 'Photos de '.$userPseudo;
}