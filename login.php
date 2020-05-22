<?php

// on définit notre balise title
$title = "Page de Connection";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

// on définit le décalage horaire par défaut de toutes les fonctions date/heure
date_default_timezone_set('Europe/Paris');

// on check l'input pour le mail,password
// si il y une erreur on affecte le problème dans la variable d'erreur 
// qui s'occupe d'aficher dans une pop-up toutes les erreurs si il y en a

$erreur = '';

if (isset($_POST['bouton'])) {
    $erreur = Formulaire::checkEmailFomat('email', $erreur);
    $erreur = Formulaire::inputIsItEmpty('email', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('password', $erreur);
}


// si il n'y pas d'erreur et que le formulaire à été validé
if (empty($erreur) && isset($_POST['bouton'])) {
    // on récupère depuis la database le password uniquement de celui qui a le meme mail
    // que le mail qui vient d'être rentré par le visiteur
    $exist = User::isItUserExist($_REQUEST['email']);
    $exist = $exist->res;
    $verify = false;

    if ($exist != '0') {
        $res = User::getHashPassword($_REQUEST['email']);
        $res = $res->password;

        // on vérifie que le mot de passe qu'il à rentré correspond bien avec le mot de passe hashé qui à été récupéré
        // précedmemment depuis la database en utilisant la fonction password_verify de php
        $verify = password_verify($_REQUEST['password'], $res);

        // si la vérification est correcte
        if ($verify === true) {
            // on vérifie en sql que l'email et le password correpondent à ce qui a été rentré dans les inputs
            $result = User::checkInformation($_REQUEST['email'], $res);
            $result = $result->id;

            // Si c'est bon on crée une variable session pour le user
            $_SESSION['login'] = $result;

            // on check que l'utilisateur à bien une session propre à lui
            Formulaire::triggerSuccessAnimation('login', 'Connection Réussi', 'index.php');
        }

        // si la vérification ne correspond pas on lui génère une erreur
        $erreur = Formulaire::checkFields($verify, $erreur);
    }

    $erreur = Formulaire::checkFields($verify, $erreur);
}

// si il y a des erreur et que le formulaire à été validé
// on lance l'animation d'erreur affichant la liste de toute les erreurs
if (isset($_POST['bouton']) && !empty($erreur)) {
    Formulaire::triggerErrorsAnimation($erreur, 'bouton');
}

// on inclut la vue (partie visible => front) de la page
require_once('views/login.view.php');

?>

