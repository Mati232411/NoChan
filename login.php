<?php
$darkmode=$_COOKIE['theme'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if($darkmode == "dark") {echo '<link rel="stylesheet" href="system/base_dark.css">'; } else {
        echo '<link rel="stylesheet" href="system/base_light.css">';} ?>
        <title>NoChan - Login</title>
        <link rel="icon" type="image/x-icon" href="/data/icon.png">
        <style>
            body {
                <?php echo $style; ?>
            }
        </style>
    </head>
    <body>
    <script>
            function read_cookie(key)
            {
                var result;
                return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? (result[1]) : null;
            }
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                var dark = "dark";
            } else { var dark = "light"; }
            if(dark != read_cookie('theme')){
                //window.location.replace(window.location.href);
                location.reload(true);
            } 
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.cookie = "theme=dark; expires=2100; path=/";
            } else {
                document.cookie = "theme=light; expires=2100; path=/";
            }
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                location.reload(true);
            });

        </script>
        <div class="register">
            <center><form id="button" action="base/login.php" method="post">
                        <h1 class="nomargintop marginbottom">Log in</h1>
                        <input id="text" type="text" name="name"><br><br>
                        <input id="text" type="password" name="pwd"><br><br>
                        <input id="button" type="submit" value="Login"><br><br>
            </form></center>
        </div>
    </body>
</html>