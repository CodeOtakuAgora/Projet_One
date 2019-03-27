<?php

// Connection à MySQL

// on se connecte à la base de donnée en renseignant 
// l'hôte, le nom de la base de donnée, l'encodage, le nom d'utilisateur, le mot de passe
// On affiche les erreur de connection PDO sous la forme d'un tableau 
$bdd = new PDO('mysql:host=localhost;dbname=hwear;charset=utf8', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>