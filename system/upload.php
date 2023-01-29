<?php
$charname_orig = $_POST['charname'];
$source_orig = $_POST['source'];

//Setting up the api keys
if(!empty($_COOKIE['apikey'])){
$api = $_COOKIE['apikey'];
include("/var/www/html/system/auth.php");
} elseif(!empty($_POST['apikey'])) {
$api = $_POST['apikey'];
include("/var/www/html/system/general.php");
} else {
    die("You must provide a valid apikey");
}
$qname = $udata['qname'];
$name = $udata['uname'];
//Preparing the file
$file=reset($_FILES);
if(empty($file['size'])){
    die('{"success": false, "msg": "Please provide a file"}');
}
$fileType=mime_content_type($file['tmp_name']);
if ($fileType != "image/png") {
	if ($fileType != "image/jpeg") {
		if($fileType != "image/gif") {
	die("You can only upload images in format: png, jpeg, gif. You uploaded $fileType");
	}}		
}
if($_POST['type'] == "pfp") {
	$uploadPath="/srv/nochan/thm/";
	$qname = $udata['qname'];
	$ext = str_replace("image/", '', $fileType);
	$filename = $qname."_pfp.".$ext;
	move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
	$filename2 = $qname."_pfp.png";
	$full_shell_exec="/usr/bin/convert /srv/nochan/thm/$filename /srv/nochan/thm/$filename2 && rm /srv/nochan/thm/$filename";
	shell_exec($full_shell_exec);
	header("Location: /profile.php");
	die();
}

//Calculating the image number
$result = mysqli_query($con,"SELECT charnum FROM img WHERE charname='{$charname_orig}';");
if(empty($result)) {
    $num = "1";
} 
else {
    $result2 = mysqli_query($con,"SELECT * FROM img WHERE charname='{$charname_orig}' ORDER BY charnum DESC LIMIT 1;");
    $tmpdata = mysqli_fetch_assoc($result2);
    $num = $tmpdata['charnum'];
    $num = $num + 1;
}

$result3 = mysqli_query($con,"SELECT * FROM img ORDER BY gnum DESC;");
$tmpdata2 = mysqli_fetch_assoc($result3);
$gnum = $tmpdata2['gnum'];
$gnum = $gnum + 1;
//File preparation and last checks

$uploadPath=$uploadlocation;
$date = date("H:i:s Y-m-d");
$fileType=mime_content_type($file['tmp_name']);
$source = preg_replace('/\s+/', '_', $_POST['source']);
$charname = preg_replace('/\s+/', '.', $charname_orig);
$ext = str_replace("image/", "", $fileType);
$filename = "$charname.($source).$num.$ext";

if ($fileType != "image/jpeg" || $fileType != "image/png" || $fileType != "image/gif"){
    header("Location: /");
}



//Upload
move_uploaded_file($file['tmp_name'], $uploadPath.$filename);
$full_shell_exec="/usr/bin/convert -resize 256 '/srv/nochan/files/$filename' '/srv/nochan/thm/$filename'";
shell_exec($full_shell_exec);


//User number of uploads generator
$unum = $udata['uploads'] + 1;

//Database update
$query = "INSERT INTO img(name, charname, charsource, uploader, date, charnum, gnum) VALUES ('{$filename}', '{$charname_orig}', '{$source_orig}', '{$name}', '{$date}', '{$num}', '{$gnum}');";
$result = mysqli_query($con,$query);
$query2 = "UPDATE users SET uploads='$unum' WHERE api='$api';";
$result2 = mysqli_query($con,$query2);
echo $api;
header("Location: /");
