<?php
    setcookie('count', isset($_COOKIE['count']) ? $_COOKIE['count']++ : 1);
    $visitCount = $_COOKIE['count'];
?>
<html> 
    <head> 
        <title>Count Page Access</title> 
    </head> 
    <body> 
        <?if ($visitCount == 1): ?>
            Welcome! This is the first time you have viewed this page. 
        <?else:?> 
            You have viewed this page <?= $_COOKIE['count'] ?> times. 
        <?endif;?>
    </body> 
</html>
