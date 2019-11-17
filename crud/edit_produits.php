<?php

// on définit notre balise title
$titleAdminCrud = "Edition du CRUD Produit";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");
// on vérifie si le formulaire à été validé
if (count($_POST) > 0) {

    // on apelle la fonction updateProduit qui appartient à la classe Produit 
    // en lui passant en paramettre les valeurs de ce qui a été rentré dans les inputs
    $prod = Produit::updateProduit($_POST["nom"], $_POST['description'], $_POST['prix'], 
        $_POST['category'], $_POST['souscategory'], $_GET["id"]);

    // on vérifie que le nom qui à été ajouté correspond bien au nom passé dans l'input
    // et on affiche le message de succès ou d'echec
    if ($prod->nom === $_POST["nom"]) {
        $message = "Record Modified Successfully";
    } else {
        $message = "Informations Invalides";
    }


}

// on apelle la fonction getProduit qui appartient à la classe Produit 
// en lui passant l'id du produit afin de mettre à jour uniquement le produit selectionné
$prod = Produit::getProduit($_GET["id"]);

// on inclut la vue (partie visible => front) de la page
require_once("views/edit_produits.view.php");
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once('../include/footer.php');
?>