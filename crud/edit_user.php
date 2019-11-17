<?php

// on définit notre balise title
$titleAdminCrud = "Edition du CRUD User";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once("../include/require.php");
// on vérifie si le formulaire à été validé
if (count($_POST) > 0) {

    // on apelle la fonction updateUser qui appartient à la classe User 
    // en lui passant en paramettre les valeurs de ce qui a été rentré dans les inputs
    $user = User::updateUser($_POST["mail"], $_POST["password"], $_POST["nom"], $_POST["prenom"], $_POST["rue"], $_POST["code_postal"], $_POST["ville"], $_POST["telephone"], $_POST['id']);

    // on vérifie que le mail qui à été ajouté correspond bien au mail passé dans l'input
    // et on affiche le message de succès ou d'echec
    if ($user->mail === $_POST["mail"]) {
        $message = "Record Modified Successfully";
    } else {
        $message = "Informations Invalides";
    }


}

// on apelle la fonction getUser qui appartient à la classe User 
// en lui passant l'id du user afin de mettre à jour uniquement le user selectionné
$user = User::getUser($_GET["id"]);

// on inclut la vue (partie visible => front) de la page
require_once("views/edit_user.view.php");
// on inclut le footer du site tout à la fin car le but est de le charger en dernier
require_once('../include/footer.php');
?>