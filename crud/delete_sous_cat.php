<?php
// on retiend l’envoi de données
ob_start();
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");

//on apelle la fonction deleteCat qui appartient à la classe Categorie en lui passant en paramettre 
// l'id de la catégorie pour filtrer la catégorie qui à bien été selectionné
Categorie::deleteSousCat($_GET["id"]);
// ensuite on le redirige vers la page principale du crud
header("Location:index.php");

// on libère l'envoie de données
ob_end_flush();
?>