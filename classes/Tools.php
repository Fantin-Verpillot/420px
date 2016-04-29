<?php

class Tools
{
    public static function validate($var) {
        return $var !== null;
    }

    public static function validateAll($vars) {
        foreach ($vars as $var) {
            if ($var === null) {
                return false;
            }
        }
        return true;
    }

    public static function internalError()
    {
        $alert_error = 'Erreur interne, contactez votre administrateur (une requête en base de données à échoué).';
        require_once 'views/error.php';
        require_once 'views/footer.php';
        return $alert_error;
    }
}