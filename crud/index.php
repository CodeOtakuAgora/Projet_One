<?php
// on définit notre balise title
$titleAdminCrud = "Accueil du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");

// on apelle la fonction updateUser qui appartient à la classe User 
// en ne lui passant aucun parametre
$result = User::getAllUser();
$result2 = Categorie::getAllCategories();
$result3 = Categorie::getAllSousCategories();
$result4 = Produit::getAllProduits();

// on inclut la vue (partie visible => front) de la page
require_once("views/index.view.php");
?>

