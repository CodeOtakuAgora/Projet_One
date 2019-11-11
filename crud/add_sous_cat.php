<?php

// on définit notre balise title
$titleAdminCrud = "Ajout du CRUD Sous Catégorie";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");

// on vérifie si le formulaire à été validé
if (count($_POST) > 0) {
	// on apelle la fonction setUser qui appartient à la classe User en lui passant en paramettre 
	// les valeurs de ce qui a été rentré dans les inputs
    $user = Categorie::setSousCategorie($_POST["nom"],$_POST["category"]);

    $message = "Nouvelle Sous Catégorie Ajouté Avec Succès";
   
}

// on inclut la vue (partie visible => front) de la page
require_once("views/add_sous_cat.view.php");
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once("../include/footer.php");
?>
