<?php
include("/var/www/html/system/general.php");
$page_num=$_COOKIE['page'];
if(isMobile()) {
    $mobile = "1";
}
if (!empty($_GET['gnum'])) {
    $gnum=$_GET['gnum'];
    $result = mysqli_query($con,"SELECT * FROM img WHERE gnum = '$gnum'");
    $row = mysqli_fetch_array($result);
}
$charname = $row['charname'];
$charsource = $row['charsource'];
$title = "NoChan - Character: $charname Image: $gnum";
if($mobile == "1") {
    $dl = "<a href='/store/{$row['name']}'><button>Download</button></a>";
    $layout_mobile = "<td><center><b>Character name: {$charname} </b></br>
    Character source: {$charsource} </center></td>";
} else {
    $dl = "<form action='/base/download.php' method='post'>
    <input type='hidden' name='image_name' value={$row['name']}><input type='submit' value='Download' />
    </form>";
    $layout_desktop = "<td><center><b>Character name: {$charname} </b></br>
    Character source: {$charsource}</center></td>";
}

$darkmode=$_COOKIE['theme'];
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
	<?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="system/base_dark.css">'; } else {
        echo '<link rel="stylesheet" href="system/base_light.css">';} ?>    
	<style>
            b {
                font-size: 22px;
            }
            <?php echo $other; ?>
        </style>
        <script src=/system/darkmode.js></script>
</head>
       <a href="/?page=<?php echo $page_num; ?>"><button>Back to the homepage</button></a>
    <body><center>
            <table>
                    <tr>    
                        <td><img width=384 src="/store/<?php echo $row['name'] ?>"></td>
                        <?php echo $layout_desktop; ?>
                    </tr>
                    <tr><?php echo $layout_mobile; ?></tr>
                    <tr>
                        <td><center><?php echo $dl; ?></td>
                    </tr>
            </table>
</body>
</html>
