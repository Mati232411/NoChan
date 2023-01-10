<?php
include("/var/www/html/system/general.php");
?>
<html>
<head>
    <title>Upload - NoChan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <center><form action="/system/upload.php" method="post" enctype="multipart/form-data">
        <input id="charname" type="text" name="charname"><br><br>
        <input id="source" type="text" name="source"><br><br>
        <input class="upload" type="file" name="file" id="inputFile"><br />
        <input type="submit" value="Upload" name="submit">
    </form>
    </br>
    </br>
    <table style="fit-content" border="0">
                    <tr>
                        <th>Character</th>
                        <th>Source of Character</th>
                    </tr>
                    <tr>
                    <?php
                        $i=0;
                        $result = mysqli_query($con,"SELECT DISTINCT charname,charsource FROM img ORDER BY date DESC;");
                        while($row = mysqli_fetch_array($result)) {
                    ?>
                    
                    <tr>
                        <td><?php echo $row["charname"]; ?></td>
                        <td><?php echo $row["charsource"]; ?></td>
                    </tr>
                    <?php
                    $i++;    
                    }
                    ?>
    </table>
</body>