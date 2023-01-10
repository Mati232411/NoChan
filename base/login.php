<?php 
include("/var/www/auth.php");
$uid = $_POST['name'];
$query = "select * from users where uname = '$uid'";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
if(empty($data['qname'])) {
    $query = "select * from users where qname = '$uid'";
    $result = mysqli_query($con,$query);
    $data = mysqli_fetch_assoc($result);
}
if(empty($data['pwd'])){
    die('Wrong username');
}
if(password_verify($_POST['pwd'], $data['pwd'])==false){
    die('Wrong password');
}
if($_GET['rauth'] == "1") {
    $api_int=$_GET['apicall'];
    $oldurl=$_SERVER['HTTP_REFERER'];
    $target = $data['api'];
    $full = "$oldurl$api_int?source=nochan&api=$target";
} else {
    $full = "/";
}
//echo $full;
// Setting "expire" to 0 so the cookie is deletted when the browser closes
if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
setcookie('apikey', $data['api'], 0, '/', null, true);
} else {
    setcookie('apikey', $data['api'], 0, '/', null);
}
header("Location: $full");
?>
