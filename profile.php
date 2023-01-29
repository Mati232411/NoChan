<?php
$page_num=$_COOKIE['page'];
if (!empty($_GET['qname'])) {
$name=$_GET['qname'];
include("/var/www/html/system/general.php");
$query = "SELECT uname FROM users WHERE qname='$name';";
$result = mysqli_query($con,$query);
$tmp = mysqli_fetch_assoc($result);
$uname = $tmp['uname'];
$fav = fav($con,$uname);
} else {
	$api = $_COOKIE['apikey'];
	include("/var/www/html/system/general.php");
	$name = $udata['qname'];
}
	$query = "SELECT COUNT(charname) FROM img WHERE uploader='$uname';";
	$result = mysqli_query($con,$query);
	$tmp = mysqli_fetch_assoc($result);
	$upl=$tmp['COUNT(charname)'];
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$pfp = $link."/thm/".$name."_pfp.png";
$darkmode=$_COOKIE['theme'];

?>
<html>
    <head>
        <title>NoChan - Profile</title>
	<script src=system/darkmode.js></script>
	<?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="system/base_dark.css">'; } else {
        echo '<link rel="stylesheet" href="system/base_light.css">';} ?>
    </head>
    <body>
	<a href="/?page=<?php echo $page_num; ?>"><button>Back to the homepage</button></a>
        <center><table border=0>
            <tr>
	    <td><a href="/system/user_upl.php"><img width=128 src=<?php echo $pfp; ?> /></a></td>
	    <td><center><h3>User's full name: <?php echo $uname; ?></h3></br><p>Username: <?php echo $name; ?></p></center></td>
            </tr>
            <tr>
	    	<td></td>
		<td>Uploaded: <?php echo $upl; ?></br>Favorite charcter: <b><?php echo $fav['charname']; ?></b></br>Rank: To be finished</td>
            </tr>
        </table>
    </body>
</html>
