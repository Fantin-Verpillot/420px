<?php

$images = Image::getImagesByUser($pdo, $_GET['param']);
$userPseudo = User::getUserPseudoById($pdo, $_GET['param']);
$userId = $_GET['param'];
header('Content-Type: application/rss+xml; charset=utf-8');