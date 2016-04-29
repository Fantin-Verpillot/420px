<?php

if (isset($_GET['action']) && $_GET['action'] === 'disconnect') {
    session_destroy();
    $idUserConnected = 0;
    require_once 'views/header_dc.php';
    require_once 'views/home_dc.php';
    require_once 'views/footer_dc.php';
    exit();
} elseif (isset($_GET['action']) && $_GET['action'] === 'rss' && isset($_GET['param']) && User::exists($pdo, $_GET['param'])) {
    require_once 'controllers/rss.php';
    require_once 'views/rss.php';
    exit();
}

$idUserConnected = $_SESSION['user']['id'];
require_once 'views/header.php';

if (isset($_GET['action'])) {
    switch($_GET['action']) {
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
        case 'delete' : {
            if (isset($_GET['param']) && Image::exists($pdo, $_GET['param']) && Image::ownedBy($pdo, $_GET['param'], $idUserConnected)) {
                Image::deleteImage($pdo, $_GET['param']);
                $_GET['param'] = $idUserConnected;
                require_once 'controllers/user.php';
                require_once 'views/user.php';
                $alert_error = 'La photo a disparu de votre page.';
                break;
            }
        }
        case 'upload' : {
            if (isset($_POST['upload']) && !empty($_FILES['file']['name'])) {
                require_once 'controllers/upload.php';
                $_GET['param'] = $idUserConnected;
                require_once 'controllers/user.php';
                require_once 'views/user.php';
            } else {
                require_once 'views/upload.php';
            }
            break;
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

require_once 'views/footer.php';
