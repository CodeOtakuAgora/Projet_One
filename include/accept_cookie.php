<?php
// une fois que la bannière qui informe l'utilisation de cookie sur le site
// à été validé on créer un cookie qui durera 24h soit 1 jour dans le cache du navigateur
// ce qui fera disparaître la bannière sur tout le site pendant 24h 
// si vous voulez la faire réaparaitre vous avez juste à supprimer vos cookies
setcookie('cdd', true, time() + 24 * 60 * 60, '/', null, false, true);
// puis on le redirige vers la page ou il était avant d'avoir clické
header('location:' . $_SERVER['HTTP_REFERER']);
?>