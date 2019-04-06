<?php
function nbclients($bdd){
    $request = $bdd->query('SELECT COUNT(*) AS nbclients FROM `users`');
    $nbclients = $request->fetch();
    return $nbclients;
}

?>