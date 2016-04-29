<?php
$users = Image::getImagesByUsers($pdo);
$userPseudos = User::getUserPseudosById($pdo);

if (!Tools::validateAll(array($users, $userPseudos))) {
    $alert_error = Tools::internalError();
    exit();
}