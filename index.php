<?php
session_start();

require_once 'include/settings.php';
require_once 'classes/Login.php';

$pdo = new PDO(DSN_DB, USER_DB, PASSWORD_DB);

if (isset($_POST['login'])) {
    $user = Login::getUser($pdo, $_POST['pseudo'], $_POST['password']);
    if ($user) {
        Login::connectUser($user);
    } else {
        $alert_error = 'La combinaison pseudo/mot de passe est incorrecte.';
    }
} elseif (isset($_POST['register'])) {
    //inscris
}

if (isset($_SESSION['user'])) {
    require_once 'views/home_c.php';
} else {
    //$alert_error = 'coucou philippe';
    require_once 'views/home_dc.php';
}

?>