<?php
include("/var/www/html/system/general.php");
setcookie('page', $_GET['page'], 0, '/', null);
if (isMobile()) {
    $mobile = 1;
}
if(empty($_COOKIE['apikey'])) {
    $loggedin = "0";
} else {
    //$name = $udata['uname'];
    $loggedin = "1";
}
if(!empty($_GET['charname'])) {
    $tmp=$_GET['charname'];
    $other = "charname=$tmp";
    $parameters = "WHERE charname='$tmp'";
    $clear_param = "<a href='/'>Clear Selection</a>";
} else {$other="";}
$max1 = mysqli_query($con, "SELECT COUNT(*) FROM img $parameters;");
$max=mysqli_fetch_array($max1);
$max=$max['COUNT(*)'];
$darkmode=$_COOKIE['theme'];
?>
<html>
    <head>
        <title>NoChan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="system/base_dark.css">'; } else {
        echo '<link rel="stylesheet" href="system/base_light.css">';} ?>
        <style type="text/css">
  td {
    padding: 0 20px;
  }
        </style>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <script src=/system/darkmode.js></script>
    </head>
    <body>
        <div class="topbar">
            <?php if($loggedin == "0") { echo "
            <form id='button' action='/login.php' method='post'><input id='button' type='submit' value='Login'></form>
            <form id='button' action='/register.php' method='post'><input id='button' type='submit' value='Sign Up'></form>
            "; } elseif($loggedin == "1") { echo "
	<form id='button' action='/profile.php'><input id='button' type='submit' value='Profile'></form>
        <form id='button' action='/settings.php'><input id='button' type='submit' value='Settings'></form>
            <form id='button' action='/upload.php' method='post'><input id='button' type='submit' value='Upload'></form>
            ";
            }
        ?>
        </div>
        <center><div class="statictitle">
            <h1>NoChan</h1>
            </div>
            <div class="images">
                <table style="fit-content" border="0">
                    <tr>
                        <td></td>
                        <td>Character</td>
                        <td>Uploader</td>
                    </tr>
                    <tr>
                    <?php                        
                        if(empty($_GET['page'])){
                        $i=0;
                        $i2 = 0;
                        $result = mysqli_query($con,"SELECT * FROM img $parameters ORDER BY gnum DESC;");
                        $nextpage = "2";
                        } else {
                            $i = $_GET['page'] * 4 - 4;
                            $i2 = 0;
                            $result = mysqli_query($con,"SELECT * FROM img $parameters ORDER BY gnum DESC LIMIT 18446744073709551610 OFFSET {$i};");
                            $nextpage = $_GET['page'] + 1; $prevpage = $_GET['page'] - 1; $curpage = $_GET['page'];
                        }
                        while($row = mysqli_fetch_array($result)) {
                        $charname=$row['charname'];
                        $full_parameter="?charname=$charname";
                        ?>
                    
                    <tr>
                        <td><a href="/info.php?gnum=<?php echo $row['gnum']; ?>"><img width=256 src=/thm/<?php echo $row['name']; ?>></a></td>
                        <td><p><a href='/<?php echo $full_parameter; ?>'><?php echo $row["charname"]; ?></a></p></td>
			<td><a href="/profile.php?qname=<?php $uname2 = $row['uploader']; echo getqname($con,$uname2); ?>"><?php echo $row["uploader"]; ?></a></td>
                    </tr>
                    <?php
                        $i2++; $i++;
                        $max1 = $max - $i;
                        if($i2 == "4"){$next = "1"; pagesel($nextpage,$prevpage,$mobile,$max1,$other); break; };
                    }
                    if($next != "1") {unset($nextpage); pagesel($nextpage,$prevpage,$mobile,$max1,$other); }
                    ?>
                </table>
            </div>
            <div class="bottom_clear"><?php echo $clear_param;?></div>
    </body>
</html>
