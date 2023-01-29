<?php
if(empty($_COOKIE['apikey'])) {
	header("Location: /");
}
$api = $_COOKIE['apikey'];
include("/var/www/html/system/general.php");
$darkmode=$_COOKIE['theme'];
?>
<html>
    <head>
        <title>NoChan - Settings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="/system/base_dark.css">'; } else {echo '<link rel="stylesheet" href="/system/base_light.css">';} ?>
    	<script src=/system/darkmode.js></script>
    </head>
    <body>
        <a href="/profile.php"><button>Back to profile</button></a>
	<center>
		<h2><?php echo "$uname - Settings";?></h2>
		<table border=1>
<?php $wallpaper="
	<tr><td><center><h3>User's wallpaper:</h3>
		<form method='post' action='/system/upload.php' enctype='multipart/form-data'>
    		<input type=hidden name='type' value='wallpaper' />
		<input type='hidden' name='api' value=$api>
		<input class='upload' type='file' name='file' id='inputFile'></br>
    		<input type='submit' value='Submit' />
    		</form>
	</td></tr>";
	$pfp="<tr><td><center><h3>User Profile Picture</h3>
    		<form action='/system/upload.php' method='post' enctype='multipart/form-data'>
        	<input type='hidden' name='api' value=$api>
        	<input type='hidden' name='type' value='pfp'>
		<input class='upload' type='file' name='file' id='inputFile'><br />
        	<input type='submit' value='Upload' name='submit'>
	</form></td></tr>"; 
	if($_GET['type'] == "wallpaper") { 
		echo $wallpaper;	
	} elseif($_GET['type'] == "pfp") {
		echo $pfp;
	} else {
		echo $pfp;
		echo $wallpaper;
	}
?>
	</table>
    </body>
</html>
