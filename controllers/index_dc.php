<?php

$idUserConnected = 0;
require_once 'views/header_dc.php';

if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'gallery' : {
            require_once 'controllers/home.php';
            require_once 'views/home.php';
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
            require_once 'views/home_dc.php';
        }
    }
} else {
    require_once 'views/home_dc.php';
}

require_once 'views/footer_dc.php';
