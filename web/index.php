<?php

$name = "visitCount";

if (!isset($_COOKIE[$name])) {
    $_COOKIE[$name] = 0;
}
$_COOKIE[$name] = 1 + (int) max(0, $_COOKIE[$name]);
$result = setcookie($name, $_COOKIE[$name]);
if (!$result) {
    throw new RuntimeException("Failed to set cookie \"$name\"");
}
<html> 
    <head> 
        <title>Count Page Access</title> 
    </head> 
    <body> 
        <?if ($visitCount == 1): ?>
            Welcome! This is the first time you have viewed this page. 
        <?else:?> 
            You have viewed this page <?= $_COOKIE['$name'] ?> times. 
        <?endif;?>
    </body> 
</html>
