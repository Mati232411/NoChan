<?php 
if(empty($_COOKIE['apikey'])){
    header("Location: /");
}
include("/var/www/html/system/general.php");
?>