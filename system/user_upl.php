<?php
include("/var/www/html/system/general.php");
$darkmode=$_COOKIE['theme'];
?>
<html>
<head>
    <title>Upload User - NoChan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="base_dark.css">'; } else {echo '<link rel="stylesheet" href="base_light.css">';} ?>
    <script src=darkmode.js></script>
</head>
<body>
    <center>
	<h2>User Profile Picture</h2>	
    <form action="/system/upload.php" method="post" enctype="multipart/form-data">
	<input id="api" type="hidden" name="api" value="<?php echo $_COOKIE['apikey']; ?>">
        <input id="api" type="hidden" name="type" value="pfp">
        <input class="upload" type="file" name="file" id="inputFile"><br />
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
