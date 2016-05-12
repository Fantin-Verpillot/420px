<?php

$target_dir = 'files/';
$uploadOk = true;
$imageFileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

$check = getimagesize($_FILES['file']['tmp_name']);
if($check === false) {
    $alert_error = 'Seules les images sont prises en charge.';
    $uploadOk = false;
}

if($uploadOk && ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif')) {
    $alert_error = 'Seuls les formats JPG, JPEG, PNG & GIF sont pris en charge.';
    $uploadOk = false;
}

if ($uploadOk && $_FILES['file']['size'] > 1000000) {
    $alert_error = 'La fichier est trop volumineux.';
    $uploadOk = false;
}

$rgb = Image::getDominantRGB($_FILES['file']['tmp_name'], $imageFileType == 'jpg' ? 'jpeg' : $imageFileType);
$idImage = Image::addImage($pdo, $idUserConnected, $imageFileType, $rgb);
if (!Tools::validate($idImage)) {
    $alert_error = Tools::internalError();
    exit();
}
$target_file = $target_dir.'img_'.$idImage.'.'.$imageFileType;


if ($uploadOk) {
    $extension = $imageFileType == 'jpg' ? 'jpeg' : $imageFileType;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file) && Image::resize($target_file, $extension)) {
        $alert_error = 'La photo est maintenant disponible sur votre page.';
    } else {
        $alert_error = 'Une erreur est survenue pendant la transaction.';
    }
}