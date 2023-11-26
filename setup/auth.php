<?php
$dbhost = "";
$dbuser = "powernet";
$dbpass = "";
$dbname = "nochan";

$creation = "1";
$uploadlocation = "/srv/nochan/files/";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

        die("failed to connect!");
}
?>
