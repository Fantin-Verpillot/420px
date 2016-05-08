<?php

$images = Image::getImagesByUser($pdo, $_GET['param']);
$userPseudo = User::getUserPseudoById($pdo, $_GET['param']);

if (!Tools::validateAll(array($images, $userPseudo))) {
    $alert_error = Tools::internalError();
    exit();
}

$userId = $_GET['param'];
header('Content-Type: application/rss+xml; charset=utf-8');
//header('Content-Type: text/xml');