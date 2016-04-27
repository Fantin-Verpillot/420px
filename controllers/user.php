<?php

$images = Image::getImagesByUser($pdo, $_GET['param']);
$userPseudo = User::getUserPseudoById($pdo, $_GET['param']);
if ($_GET['param'] === $_SESSION['user']['id']) {
    $userPseudo = 'Vos photos';
} else {
    $userPseudo = 'Photos de '.$userPseudo;
}