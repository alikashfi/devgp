<?php

function file_sanitize($file_name) {
    $file_name = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file_name);
    return mb_ereg_replace("([\.]{2,})", '', $file_name);
}

/** returns env FRONT_URL */
function furl($path = null) {
    return env('FRONT_URL') . '/' . $path;
}