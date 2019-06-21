<?php


function isUploadedFileaVideo($uploadFile, $approvedTypes =  [
    // flash
    'video/x-flv',

    'video/mp4',

    // iphone
    'application/x-mpegURL',
    'video/MP2T',

    // mobile
    'video/3gpp',

    // mov
    'video/quicktime',

    'video/x-msvideo',

    // windows
    'video/x-ms-wmv',
])
{
    if (!$size = filesize($uploadFile["tmp_name"])) return false;
    if (!in_array($uploadFile["type"], $approvedTypes)) return false;

    return true;
}


function uploadvideo($file)
{
    if (isUploadedFileaVideo($file)) {
        $extention = pathinfo($file["name"], PATHINFO_EXTENSION);
        $uploadFile = _ROOT . "/videos";
        $currentName = uniqid() . "." . $extention;
        $destination = $uploadFile . "/" . $currentName;

        if (move_uploaded_file($file["tmp_name"], $destination)) {
            return $currentName;
        }

        return false;
    }
}
