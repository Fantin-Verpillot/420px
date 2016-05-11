<?php

if (isset($_POST['search'])) {
    $rgbArray = explode(',', $_POST['rgb']);
    if (count($rgbArray) == 3) {
        $rgb = array();
        $rgb['r'] = trim($rgbArray[0]);
        $rgb['g'] = trim($rgbArray[1]);
        $rgb['b'] = trim($rgbArray[2]);
        $images = Image::getImagesByRGB($pdo, $rgb);
        if (!Tools::validate($images)) {
            $alert_error = Tools::internalError();
            exit();
        }
    } else {
        $alert_error = 'Veuillez suivre le format RGB demandé.';
    }

}