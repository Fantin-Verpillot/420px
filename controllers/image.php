<?php

$imageTemp = Image::getImageById($pdo, $_GET['param']);
$image = $imageTemp['path'];
$imageId = $_GET['param'];
$userPseudo = User::getUserPseudoById($pdo, $imageTemp['user_id']);
$userId = $imageTemp['user_id'];
if ($userId === $idUserConnected) {
    $userPseudo = 'Photo &agrave; vous';
} else {
    $userPseudo = 'Photo de '.$userPseudo;
}
