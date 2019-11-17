<?php
// on retiend l’envoi de données afin d'éviter d'avoir un erreur 
// par rapport à la surcharge de l'envoie de donnée
ob_start();
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");

//on apelle la fonction deleteUser qui appartient à la classe User en lui passant en paramettre 
// l'id du user pour filtrer le user qui à bien été selectionné
User::deleteUser($_GET["id"]);
// ensuite on le redirige vers la page principale du crud
header("Location:index.php");

// on libère l'envoie de données
ob_end_flush();
?>