<?php
if(empty($_COOKIE['apikey'])) {
    die("You must login into the service");
}
include("/var/www/html/system/general.php");
$charnum = $_POST['gnum'];

//Image information
$result = mysqli_query($con, "SELECT * FROM img WHERE gnum = '$charnum';");
$data = mysqli_fetch_array($result);

//Check if comment file exists
$filename = $data['name'];
if(file_exists("/srv/nochan/files/$filename.txt")) {
    echo "Exists";
} else {
    $cmd = "touch '/srv/nochan/files/$filename.txt'";
    shell_exec($cmd);
}
$udata = udata($con,$api);
echo $udata['uname'];
echo $user;
$comment = "$user: $text";
echo $comment;
