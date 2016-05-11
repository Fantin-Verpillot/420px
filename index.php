<?php
session_start();

require_once 'include/settings.php';
require_once 'classes/Tools.php';
require_once 'classes/User.php';
require_once 'classes/Image.php';

try {
    $pdo = new PDO(DSN_DB, USER_DB, PASSWORD_DB);
} catch (PDOException $e) {
    $alert_error = 'Erreur interne, contactez votre administrateur (la connexion à la base de données à échoué).';
    require_once 'views/header_dc.php';
    require_once 'views/home_dc.php';
    require_once 'views/footer.php';
    exit();
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$internalError = false;

if (isset($_POST['login'])) {
    if (User::checkCredential($_POST['pseudo'], $_POST['password'])) {
        $user = User::getUser($pdo, $_POST['pseudo'], $_POST['password']);
        if ($user) {
            User::connectUser($user);
        } elseif (Tools::validate($user)) {
            $alert_error = 'La combinaison pseudo/mot de passe est incorrecte.';
        } else {
            $internalError = true;
        }
    } else {
        $alert_error = 'Le pseudo et/ou le mot de passe est vide.';
    }
} elseif (isset($_POST['register'])) {
    if (User::checkCredential($_POST['pseudo'], $_POST['password'])) {
        $user = User::registerUser($pdo, $_POST['pseudo'], $_POST['password']);
        if (count($user) !== 0) {
            User::connectUser($user);
            if (!Tools::validate($user)) {
                $internalError = true;
            }
        } elseif (Tools::validate($user)) {
            $alert_error = 'Le pseudo est indisponible.';
        } else {
            $internalError = true;
        }
    } else {
        $alert_error = 'Le pseudo et/ou le mot de passe est vide.';
    }
}

if ($internalError) {
    $alert_error = 'Erreur interne, contactez votre administrateur (une requête en base de données à échoué).';
}

if (isset($_SESSION['user'])) {
    require_once 'controllers/index.php';
} else {
    require_once 'controllers/index_dc.php';
}