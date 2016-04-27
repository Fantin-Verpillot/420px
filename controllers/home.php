<?php
$users = Image::getImagesByUsers($pdo);
$userPseudos = User::getUserPseudosById($pdo);
$idUserConnected = $_SESSION['user']['id'];