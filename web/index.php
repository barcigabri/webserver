<?php
    setcookie('contatore', isset($_COOKIE['contatore']) ? $_COOKIE['contatore']++ : 1, time() + (86400*7), "/");
    $ContaVisite = $_COOKIE['contatore'];
?>
<html> 
    <head> 
        <title>Contatore accessi</title> 
    </head> 
    <body> 
        <?if ($ContaVisite == 1): ?>
            Benvenuto! E' la prima volta che visiti questa pagina!. 
        <?else:?> 
            Hai già visitato questa pagina <?= $_COOKIE['contatore'] ?> volte. 
        <?endif;?>
    </body> 
</html>
