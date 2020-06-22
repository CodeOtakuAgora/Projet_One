<?php

// on définit notre balise title
$title = "Connection Admin";
// on inclut notre package (librairie) qui s'occupe de charger toutes les pages dont on a besoin
require_once('include/require.php');

$erreur = '';

if (isset($_POST['bouton'])) {
    $erreur = Formulaire::inputIsItEmpty('login', $erreur);
    $erreur .= Formulaire::inputIsItEmpty('password', $erreur);
}

// on check l'input pour le login,password
// si il y une erreur on affecte le problème dans la variable d'erreur 
// qui s'occupe d'aficher dans une pop-up toutes les erreurs si il y en a

// si il n'y a pas d'erreur et que le formulaire à été validé
if (empty($erreur) && isset($_POST['bouton'])) {

    // on récupère depuis la database le password uniquement de celui qui a le meme mail
    // que le mail qui vient d'être rentré par le visiteur
    $exist = Admin::isItAdminExist($_REQUEST['login']);
    $exist = $exist->res;
    $verify = false;

    if ($exist != '0') {
        // on récupère depuis la database le password uniquement de celui qui a le meme login
        // que le login qui vient d'être rentré par le visiteur
        $res = Admin::getHashAdminPassword($_REQUEST['login']);
        $res = $res->password;

        //  on vérifie que le mot de passe qu'il à rentré correspond bien avec le mot de passe hashé qui à été récupéré
        // précedmemment depuis la database en utilisant la fonction password_verify de php
        $verify = password_verify($_REQUEST['password'], $res);

        // si la vérifiquation est correcte
        if ($verify === true) {

            // on vérifie en sql que le login et le password correpondent bien à ce qui a été rentré dans les inputs
            // Si c'est bon on crée une variable session pour l'admin
            $result = Admin::checkAdminInformation($_REQUEST['login'], $res);
            $result = $result->login;

            // Si c'est bon on crée une variable session pour le user
            $_SESSION['login'] = $result;

            //  on lance l'animation de success puis on redirige sur la page principale
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
require_once('views/adminConnect.view.php');

?>