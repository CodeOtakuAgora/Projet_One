<?php
// on définit notre balise title
$titleUser = "Page Profil";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

$erreur = '';
$base = dirname(__FILE__);

// on vérifie que c'est bien le user qui est connecté
if (isset($_SESSION['login']) && $_SESSION['login'] != "admin") {
    // on définit le chemin du dossier pour stocker l'image
    // puis on stocke le nom, l'extension de l'image ainsi que le chemin relatif de l'endroit ou l'image doit etre stocké
    if (isset($_POST['bouton'])) {
        $image = Formulaire::checkSecureInput($_FILES["logo"]["name"]["0"]);
        $imagePath = $base . '/ressources/vetements/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

        if (!empty($_FILES["logo"]["name"]["1"])) {
            $image2 = Formulaire::checkSecureInput($_FILES["logo"]["name"]["1"]);
            $imagePath2 = $base . '/ressources/vetements/' . basename($image2);
            $imageExtension2 = pathinfo($imagePath2, PATHINFO_EXTENSION);
        }
    }

    if (!empty($image) && !empty($image2)) {
        // on vérifie l'extension,taille,nom du fichier envoyé pour les 2 images
        $isUploadSuccess = true;

        //$erreur = Formulaire::countPictures()

        if (!empty($erreur)) {

            $erreur = Formulaire::verifyExtensionFile("logo", $imageExtension, $erreur);
            $erreur = Formulaire::verifyExtensionFile("logo", $imageExtension2, $erreur);

            $erreur = Formulaire::verifyAlreadyFileExist("logo", $imagePath, $erreur);
            $erreur = Formulaire::verifyAlreadyFileExist("logo", $imagePath2, $erreur);

            $erreur = Formulaire::verifySizeFile($_FILES["logo"]["name"]["0"], $_FILES["logo"]["size"]["0"], "logo", $erreur);
            $erreur = Formulaire::verifySizeFile($_FILES["logo"]["name"]["1"], $_FILES["logo"]["size"]["1"], "logo", $erreur);

            if (!empty($erreur)) {
                $isUploadSuccess = false;
            }

            // on vérifie si le fichier à bien été déplacé dans le chemin spécifié
            $erreur = Formulaire::verifyUploadFile($_FILES["logo"]["tmp_name"]["0"], $isUploadSuccess, "logo", $imagePath, $erreur);
            $erreur = Formulaire::verifyUploadFile($_FILES["logo"]["tmp_name"]["1"], $isUploadSuccess, "logo", $imagePath2, $erreur);
            $isUploadSuccess = false;
        }
    }

    if (empty($erreur)) {
        $erreur = Formulaire::inputIsItEmpty('nom', $erreur);
        $erreur .= Formulaire::inputIsItEmpty('description', $erreur);
        $erreur .= Formulaire::inputIsItEmpty('prix', $erreur);
        $erreur .= Formulaire::inputFileIsItEmpty('logo', $erreur);
    }

    // si il n'y a pas d'erreur et que le formulaire a été validé 
    if (isset($_POST['bouton']) && empty($erreur)) {
        // on passe dans des variables les valeurs rentré dans les input
        $nom = $_REQUEST['nom'];
        $description = $_REQUEST['description'];
        $prix = $_REQUEST['prix'];
        $logo = basename($image);
        $logo2 = basename($image2);
        $category = $_REQUEST['category'];
        $souscategory = $_REQUEST['souscategory'];
        $id_admin = 1;
        $confirme = 0;

        // on éxecute l'insert des données pour l'ajout du produit avec confirme = 0
        // pour info un produit avec le champ confirme = 0 n'est pas encore disponible
        // à la vente, car il faut que l'admin passe cette valeur à 1
        //Produit::setProduit($nom, $description, $prix, $logo, $logo2, $category, $souscategory, $id_admin, $confirme);

        // on lance l'animation de success
        //Formulaire::triggerSuccessAnimation('login', 'Envoie Réussi', 'user.php');
    }

    // si il y a des erreur et que le formulaire à été validé
    // on lance l'animation d'erreur affichant la liste de toute les erreurs
    if (isset($_POST['bouton']) && !empty($erreur)) {
        Formulaire::triggerErrorsAnimation($erreur, 'bouton');
    }
}

// on inclut la vue (partie visible => front) de la page
require_once('views/user.view.php');

?> 