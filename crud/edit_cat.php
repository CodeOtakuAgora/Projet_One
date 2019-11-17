<?php

// on définit notre balise title
$titleAdminCrud = "Edition du CRUD Categorie";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");
// on vérifie si le formulaire à été validé
if (count($_POST) > 0) {

    // on apelle la fonction updateCat qui appartient à la classe Categorie 
    // en lui passant en paramettre les valeurs de ce qui a été rentré dans les inputs
    $cat = Categorie::updateCat($_POST["nom"], $_GET["id"]);

    // on vérifie que le nom qui à été ajouté correspond bien au nom passé dans l'input
    // et on affiche le message de succès ou d'echec
    if ($cat->nom === $_POST["nom"]) {
        $message = "Record Modified Successfully";
    } else {
        $message = "Informations Invalides";
    }


}

// on apelle la fonction getCat qui appartient à la classe Categorie 
// en lui passant l'id de la Catégorie afin de mettre à jour uniquement la catégorie selectionné
$cat = Categorie::getCat($_GET["id"]);

// on inclut la vue (partie visible => front) de la page
require_once("views/edit_cat.view.php");
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once('../include/footer.php');
?>