<?php
include("/var/www/auth.php");
//Quick functions
function udata($con,$api) {
$query = "select * from users where api = '$api' limit 1";
$result = mysqli_query($con,$query);
$user_data = mysqli_fetch_assoc($result);
return $user_data;
}
function fav($con,$uname) {
    $query = "SELECT charname, COUNT(charname) AS `value_occurrence` FROM img WHERE uploader='$uname' GROUP BY charname ORDER BY `value_occurrence` DESC  LIMIT 1;";
    $result = mysqli_query($con,$query);
    $user_data = mysqli_fetch_assoc($result);
    return $user_data;
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function pagesel($nextpage,$prevpage,$mobile,$max1,$other) {
        if(empty($prevpage)) {
            $url_next = "<a href='/?page=$nextpage&$other'><button>Next Page</button></a>";
        } elseif (empty($nextpage)) {
            $url_prev = "<a href='/?page=$prevpage&$other'><button>Previous Page</button></a>";
        } else {
            $url_next = "<a href='/?page=$nextpage&$other'><button>Next Page</button></a>";
            $url_prev = "<a href='/?page=$prevpage&$other'><button>Previous Page</button></a>";
        }
        if($max1 == 0) {
            if(empty($prevpage)) {
            $url_next="";
            $url_prev="";
            } else {
                $url_prev = "<a href='/?page=$prevpage&$other'><button>Previous Page</button></a>";
            }
        }
    
        if($mobile == "1") {
            echo "<tr>";
            echo "<td>{$url_prev}{$url_next}</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>{$url_prev}</td>";
            echo "<td></td>";
            echo "<td>{$url_next}</td>";
            echo "</tr>";
        }
    
}
function getqname($con,$uname2) {
    $query = "SELECT qname FROM users WHERE uname='$uname2';";
    $result = mysqli_query($con,$query);
    $tempdata = mysqli_fetch_assoc($result);
    return $tempdata['qname'];
}

if (!empty($_COOKIE['apikey'])) {
$udata = udata($con,$api);
$uname = $udata['uname'];
$fav = fav($con,$uname);
}
?>
