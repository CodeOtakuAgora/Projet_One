<?php
// on définit notre balise title
$titleAdminCrud = "Accueil du CRUD";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");

// on apelle à chaque fois une fonction qui nous retourne la liste de toutes les 
// utilisateurs, catégories, sous catégories, et produits qui appartient à leur classes respective 
// et on les stocke à chaque fois dans une variable qui leur est approprié
$result = User::getAllUser();
$result2 = Categorie::getAllCategories();
$result3 = Categorie::getAllSousCategories();
$result4 = Produit::getAllProduits();

// on inclut la vue (partie visible => front) de la page
require_once("views/index.view.php");
?>

