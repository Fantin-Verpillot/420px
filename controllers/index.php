<?php

if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'disconnect' : {
            session_destroy();
            require_once 'views/home_dc.php';
            break;
        }
        case 'user' : {
            if (isset($_GET['param']) && User::exists($pdo, $_GET['param'])) {
                require_once 'controllers/user.php';
                require_once 'views/user.php';
                break;
            }
        }
        case 'image' : {
            if (isset($_GET['param']) && Image::exists($pdo, $_GET['param'])) {
                require_once 'controllers/image.php';
                require_once 'views/image.php';
                break;
            }
        }
        default: {
            require_once 'controllers/home.php';
            require_once 'views/home.php';
        }
    }
} else {
    require_once 'controllers/home.php';
    require_once 'views/home.php';
}