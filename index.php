<?php
session_start();

require_once 'include/settings.php';
require_once 'classes/User.php';
require_once 'classes/Image.php';

$pdo = new PDO(DSN_DB, USER_DB, PASSWORD_DB);

if (isset($_POST['login'])) {
    if (User::checkCredential($_POST['pseudo'], $_POST['password'])) {
        $user = User::getUser($pdo, $_POST['pseudo'], $_POST['password']);
        if ($user) {
            User::connectUser($user);
        } else {
            $alert_error = 'La combinaison pseudo/mot de passe est incorrecte.';
        }
    } else {
        $alert_error = 'Le pseudo et/ou le mot de passe est vide.';
    }
} elseif (isset($_POST['register'])) {
    if (User::checkCredential($_POST['pseudo'], $_POST['password'])) {
        $user = User::registerUser($pdo, $_POST['pseudo'], $_POST['password']);
        if ($user) {
            User::connectUser($user);
        } else {
            $alert_error = 'Le pseudo est indisponible.';
        }
    } else {
        $alert_error = 'Le pseudo et/ou le mot de passe est vide.';
    }
}

if (isset($_SESSION['user'])) {
    require_once 'controllers/index.php';
} else {
    require_once 'controllers/index_dc.php';
}