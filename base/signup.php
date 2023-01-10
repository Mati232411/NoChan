<?php 
include('/var/www/auth.php');
if($creation == 0){
    die("New accounts aren't given away right now");
}
$fullname = $_POST['name'];
$qname = $_POST['qname'];
$pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);

//Api generation
$api=preg_replace('/\W/', '', base64_encode(random_bytes(35)));
$query = "INSERT INTO users(api, uname, pwd, qname) VALUES ('{$api}', '{$fullname}', '{$pwd}', '${qname}');";
$result = mysqli_query($con,$query);

$base = $uploadlocation;
//mkdir($base.$qname);

if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
    setcookie('apikey', $api, 0, '/', null, true);
    } else {
        setcookie('apikey', $api, 0, '/', null);
    }
header("Location: /");
?>