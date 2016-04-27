<?php

$imageTemp = Image::getImageById($pdo, $_GET['param']);
$image = $imageTemp['path'];
$userPseudo = User::getUserPseudoById($pdo, $imageTemp['user_id']);
$userId = $imageTemp['user_id'];
if ($userId === $idUserConnected) {
    $userPseudo = 'Photo &agrave; vous';
} else {
    $userPseudo = 'Photos de '.$userPseudo;
}
