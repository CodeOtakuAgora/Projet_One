<?php

// on définit notre balise title
$titleAdminEditUser = "Edition du CRUD Sous Categorie";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");
// on vérifie si le formulaire à été validé
if (count($_POST) > 0) {

	//$result = Categorie::getAllCategories();

    // on apelle la fonction updateUser qui appartient à la classe User 
    // en lui passant en paramettre les valeurs de ce qui a été rentré dans les inputs
    $souscat = Categorie::updateSousCat($_POST["nom"], $_POST['category'], $_GET["id"]);

    // on vérifie que le mail qui à été ajouté correspond bien au mail passé dans l'input
    if ($souscat->nom === $_POST["nom"]) {
        $message = "Record Modified Successfully";
    } else {
        $message = "Informations Invalides";
    }


}

// on apelle la fonction updateUser qui appartient à la classe User 
// en lui passant l'id du user afin de mettre à jour uniquement le user selectionné
$souscat = Categorie::getSousCat($_GET["id"]);

// on inclut la vue (partie visible => front) de la page
require_once("views/edit_sous_cat.view.php");
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once('../include/footer.php');
?>