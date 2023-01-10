<?php
$api = $_POST['api'];
include("/var/www/html/system/general.php");
$source = $_POST['source'];
$type = $_POST['type'];
switch ($type) {
    case "uname":
        echo $udata['uname'];
        break;
    case "uploads":
        echo $udata['uploads'];
        break;
    case "fav":
        echo $fav['charname'];
        break;
} 